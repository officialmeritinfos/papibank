<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountTransaction;
use App\Models\BillPayment;
use App\Models\Delivery;
use App\Models\Deposit;
use App\Models\FlightTicket;
use App\Models\GeneralSetting;
use App\Models\Investment;
use App\Models\LinkedCard;
use App\Models\LoanRequest;
use App\Models\User;
use App\Models\VirtualCardRequest;
use App\Models\Withdrawal;
use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Admin Dashboard',
            'user'     =>  $user,
            'totalUsers'=>User::where('id',$user->id)->count(),
            'totalDeposits'=>AccountTransaction::where('transaction_type', 'deposit')->count(),
            'totalWithdrawals'=>AccountTransaction::where('transaction_type', 'withdrawal')->count(),
            'pendingDeposits'=>AccountTransaction::where('transaction_type','deposit')->where('status','!=','completed')->where('status','!=','failed')->count(),
            'pendingWithdrawals'=>AccountTransaction::where('transaction_type','withdrawal')->where('status','!=','completed')->where('status','!=','failed')->count(),
            'externalCards'=>LinkedCard::count(),
            'virtualCards'=>VirtualCardRequest::count(),
            'loans'=>LoanRequest::count(),
            'bills'=>BillPayment::count(),
            'pendingBills'=>BillPayment::where('status', '!=','completed')->where('status','!=','failed')->count(),
        ];

        return view('admin.dashboard',$dataView);
    }
}
