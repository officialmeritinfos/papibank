<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AccountTransaction;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Notifications\InvestmentMail;
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
            'pageName' => 'User Dashboard',
            'user'     =>  $user,
            'web'=>$web,
            'transactions' => AccountTransaction::where('user_id',$user->id)->orderBy('id','desc')->take(10)->get(),
        ];

        return view('user.dashboard',$dataView);
    }

}
