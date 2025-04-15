<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BillPayment;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillsController extends Controller
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Bill Payments',
            'user'     =>  $user,
            'bills'    => BillPayment::where('status','pending')->orWhere('status','processing')->get()
        ];

        return view('admin.bills.list',$dataView);
    }
    //approved page
    public function approvedBill()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Approved Bill Payments',
            'user'     =>  $user,
            'bills'    => BillPayment::where('status','completed')->get()
        ];

        return view('admin.bills.list',$dataView);
    }
    //landing page
    public function failedBill()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Failed Bill Payments',
            'user'     =>  $user,
            'bills'    => BillPayment::where('status','failed')->get()
        ];

        return view('admin.bills.list',$dataView);
    }
    //details
    public function billDetails($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Bill Details',
            'user'     =>  $user,
            'bill'    =>  BillPayment::with('user')->findOrFail($id)
        ];

        return view('admin.bills.details',$dataView);
    }

    // Update the status of a bill payment
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,failed'
        ]);

        $bill = BillPayment::findOrFail($id);
        $bill->status = $request->status;
        $bill->save();

        return redirect()->back()->with('success', 'Bill payment status updated successfully.');
    }
}
