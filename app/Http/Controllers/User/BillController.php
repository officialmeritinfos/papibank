<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BillPayment;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Notifications\AdminBillPaymentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class BillController extends Controller
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Pay a Bill',
            'user'     =>  $user,
            'web'=>$web,
            'bills' => BillPayment::where('user_id',$user->id)->orderBy('id','desc')->paginate(10),
        ];

        return view('user.bill',$dataView);
    }
    /**
     * Handle the bill payment request.
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'account_number' => 'required|string',
            'amount' => 'required|numeric|min:10',
            'payee' => 'required|string|max:255',
            'address1' => 'required|string|max:512',
            'address2' => 'nullable|string|max:512',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zipcode' => 'required|string|max:20',
            'delivery_method' => 'required|in:Paper Check,Digital Receipt',
            'memo' => 'nullable|string|max:80',
            'day' => 'required|integer|min:1|max:31',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:' . date('Y') . '|max:' . (date('Y') + 10),
            'is_favorite' => 'nullable|boolean'
        ]);

        $user = Auth::user();

        // Ensure the user has enough balance
        if ($user->balance < $request->amount) {
            return back()->with('error', 'Insufficient balance for this transaction.');
        }

        // Format the delivery date
        $deliveryDate = "{$request->year}-{$request->month}-{$request->day}";

        try {
            DB::beginTransaction();

            // Create the bill payment record
            $billPayment = BillPayment::create([
                'user_id' => $user->id,
                'account_number' => $request->account_number,
                'amount' => $request->amount,
                'payee' => $request->payee,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'state' => $request->state,
                'zipcode' => $request->zipcode,
                'delivery_method' => $request->delivery_method,
                'memo' => $request->memo,
                'status' => 'pending',
                'delivery_date' => $deliveryDate,
                'is_favorite' => $request->has('is_favorite'),
            ]);

            // Deduct the amount from the user's balance
            $user->decrement('balance', $request->amount);

            DB::commit();

            // Notify the admin about the bill payment
            $admin = User::where('is_admin', 1)->first();
            if ($admin) {
                Notification::send($admin, new AdminBillPaymentNotification($billPayment));
            }

            return redirect()->route('bill.summary', ['id'=>$billPayment->id])
                ->with('success', 'Your bill payment has been initiated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    //show
    public function show($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $bill = BillPayment::where('user_id',$user->id)->findOrFail($id);
        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Bill Detail',
            'user'     =>  $user,
            'web'=>$web,
            'bill' =>$bill
        ];

        return view('user.bill_detail',$dataView);
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,failed,processing'
        ]);

        $bill = BillPayment::findOrFail($id);
        $bill->status = $request->status;
        $bill->save();

        return redirect()->back()->with('success', 'Bill payment status updated successfully.');
    }

}
