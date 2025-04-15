<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\LoanRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoansController extends Controller
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Loan Requests',
            'user'     =>  $user,
            'loans'   => LoanRequest::where('status','pending')->get()
        ];

        return view('admin.loans.list',$dataView);
    }
    public function approvedLoans()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Approved Loan Requests',
            'user'     =>  $user,
            'loans'   => LoanRequest::where('status','approved')->get()
        ];

        return view('admin.loans.list',$dataView);
    }
    public function rejectedLoans()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Rejected Loan Requests',
            'user'     =>  $user,
            'loans'   => LoanRequest::where('status','rejected')->get()
        ];

        return view('admin.loans.list',$dataView);
    }

    // Approve loan and update user balance
    public function approve($id)
    {
        $loan = LoanRequest::findOrFail($id);
        $user = User::findOrFail($loan->user_id);

        if ($loan->status === 'approved') {
            return redirect()->back()->with('warning', 'This loan has already been approved.');
        }

        // Add loan amount to the user's loan balance
        $user->loan += $loan->amount;
        $user->save();

        // Update loan status
        $loan->status = 'approved';
        $loan->save();

        return redirect()->back()->with('success', 'Loan approved successfully. Amount added to user’s loan balance.');
    }

    // Reject loan
    public function reject($id)
    {
        $loan = LoanRequest::findOrFail($id);

        if ($loan->status === 'rejected') {
            return redirect()->back()->with('warning', 'This loan has already been rejected.');
        }

        $loan->status = 'rejected';
        $loan->save();

        return redirect()->back()->with('success', 'Loan rejected successfully.');
    }

    // Delete loan request
    public function destroy($id)
    {
        $loan = LoanRequest::findOrFail($id);
        $loan->delete();

        return redirect()->back()->with('success', 'Loan request deleted successfully.');
    }
}
