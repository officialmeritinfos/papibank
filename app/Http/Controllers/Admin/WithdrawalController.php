<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountTransaction;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Withdrawals',
            'user'     =>  $user,
            'withdrawals' => AccountTransaction::where('transaction_type', 'withdrawal')->where(function ($query){
                $query->where('status','pending')->orWhere('status','processing');
            })->get()
        ];

        return view('admin.withdrawals.list',$dataView);
    }
    //landing page
    public function completedWithdrawals()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Completed Withdrawals',
            'user'     =>  $user,
            'withdrawals' => AccountTransaction::where('transaction_type', 'withdrawal')->where('status','completed')->get()
        ];

        return view('admin.withdrawals.list',$dataView);
    }
    //landing page
    public function failedWithdrawals()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Failed Withdrawals',
            'user'     =>  $user,
            'withdrawals' => AccountTransaction::where('transaction_type', 'withdrawal')->where('status','failed')->get()
        ];

        return view('admin.withdrawals.list',$dataView);
    }

    //deposit details
    public function withdrawalDetail($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $transaction = AccountTransaction::where('id', $id)
            ->where('transaction_type', 'withdrawal')
            ->with('user')
            ->firstOrFail();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Withdrawal Detail',
            'user'     =>  $user,
            'withdrawal' => $transaction
        ];

        return view('admin.withdrawals.details',$dataView);
    }
    public function updateWithdrawalStatus(Request $request, $id)
    {
        $transaction = AccountTransaction::findOrFail($id);

        // Prevent updating to the same status again
        if ($transaction->status === $request->status) {
            return back()->with('error', 'This transaction is already marked as ' . ucfirst($transaction->status) . '.');
        }

        $request->validate([
            'status' => 'required|in:pending,completed,failed,processing',
        ]);

        // Update transaction status and remarks
        $transaction->status = $request->status;
        $transaction->save();

        return back()->with('success', 'Withdrawal status updated successfully.');
    }

    public function deleteTransaction($id)
    {
        // Find the transaction by ID
        $transaction = AccountTransaction::findOrFail($id);

        // Delete the transaction
        $transaction->delete();

        // Redirect back with a success message
        return redirect()->route('admin.withdrawals.index')->with('success', 'Transaction deleted successfully.');
    }


}
