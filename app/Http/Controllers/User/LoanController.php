<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\LoanRequest;
use App\Models\User;
use App\Notifications\AdminLoanNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class LoanController extends Controller
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Loan',
            'user'     =>  $user,
            'web'=>$web,
            'loans' => LoanRequest::where('user_id',$user->id)->orderBy('id','desc')->paginate(10),
        ];

        return view('user.loan_request',$dataView);
    }
    //process loan request
    public function processLoan(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $request->validate([
            'amount' => 'required|numeric|min:15000|max:150000',
            'credit_facility' => 'required|string',
            'payment_tenure' => 'required|string',
            'reason' => 'required|string',
        ]);

        $loan = LoanRequest::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'credit_facility' => $request->credit_facility,
            'payment_tenure' => $request->payment_tenure,
            'reason' => $request->reason,
        ]);

        // Notify Admin
        $admin = User::where('is_admin', 1)->first();
        if ($admin) {
            Notification::send($admin, new AdminLoanNotification($loan,$user));
        }

        return redirect()->back()->with('success', 'Your loan request has been submitted. You will receive a notification within 24 Hours');
    }
    //list of loans
    public function loans()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Loan',
            'user'     =>  $user,
            'web'=>$web,
            'loans' => LoanRequest::where('user_id',$user->id)->orderBy('id','desc')->get(),
        ];

        return view('user.loans',$dataView);
    }
}
