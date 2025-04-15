<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountTransaction;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Deposits',
            'user'     =>  $user,
            'deposits' => AccountTransaction::where('transaction_type', 'deposit')->where(function ($query){
                $query->where('status','pending')->orWhere('status','processing');
            })->get()
        ];

        return view('admin.deposit.list',$dataView);
    }
    //landing page
    public function completedDeposits()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Completed Deposits',
            'user'     =>  $user,
            'deposits' => AccountTransaction::where('transaction_type', 'deposit')->where('status','completed')->get()
        ];

        return view('admin.deposit.list',$dataView);
    }
    //landing page
    public function failedDeposit()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Failed Deposits',
            'user'     =>  $user,
            'deposits' => AccountTransaction::where('transaction_type', 'deposit')->where('status','failed')->get()
        ];

        return view('admin.deposit.list',$dataView);
    }
    //deposit details
    public function depositDetail($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $transaction = AccountTransaction::where('id', $id)
            ->where('transaction_type', 'deposit')
            ->with('user')
            ->firstOrFail();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Deposit Detail',
            'user'     =>  $user,
            'transaction' => $transaction
        ];

        return view('admin.deposit.details',$dataView);
    }
    public function updateDepositStatus(Request $request, $id)
    {
        $transaction = AccountTransaction::findOrFail($id);

        // Prevent updating to the same status again
        if ($transaction->status === $request->status) {
            return back()->with('error', 'This transaction is already marked as ' . ucfirst($transaction->status) . '.');
        }

        $request->validate([
            'status' => 'required|in:pending,completed,failed,processing',
            'admin_remarks' => 'nullable|string|max:255',
        ]);

        // If the transaction is completed, update the user's balance
        if ($request->status === 'completed') {
            $user = $transaction->user;

            // Ensure the transaction was not previously completed
            if ($transaction->status !== 'completed') {
                $user->balance += $transaction->final_amount;
                $user->save();
            }
        }

        // Update transaction status and remarks
        $transaction->status = $request->status;
        $transaction->save();

        return back()->with('success', 'Deposit status updated successfully.');
    }

    public function deleteTransaction($id)
    {
        // Find the transaction by ID
        $transaction = AccountTransaction::findOrFail($id);

        // Delete the transaction
        $transaction->delete();

        // Redirect back with a success message
        return redirect()->route('admin.deposits.index')->with('success', 'Transaction deleted successfully.');
    }


}
