<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankTransferMethod;
use App\Models\CryptocurrencyMethod;
use App\Models\GeneralSetting;
use App\Models\GiftCardMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentMethodController extends Controller
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $cryptos = CryptocurrencyMethod::latest()->get();
        $giftCards = GiftCardMethod::latest()->get();
        $banks = BankTransferMethod::latest()->get();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Payment Methods',
            'user'     =>  $user,
            'cryptos'  =>  $cryptos,
            'giftCards' =>  $giftCards,
            'banks'    =>  $banks,
        ];

        return view('admin.paymentMethod.list',$dataView);
    }

    // Store Cryptocurrency Method
    public function storeCrypto(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'wallet' => 'required|string|max:255',
            'network' => 'required|string|max:255'
        ]);

        CryptocurrencyMethod::create($request->all());

        return redirect()->back()->with('success', 'Cryptocurrency method added successfully.');
    }

    // Delete Cryptocurrency Method
    public function destroyCrypto($id)
    {
        CryptocurrencyMethod::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Cryptocurrency method deleted successfully.');
    }

    // Store Gift Card Method
    public function storeGiftCard(Request $request)
    {
        $request->validate([
            'merchant' => 'required|string|max:255'
        ]);

        GiftCardMethod::create($request->all());

        return redirect()->back()->with('success', 'Gift Card method added successfully.');
    }

    // Delete Gift Card Method
    public function destroyGiftCard($id)
    {
        GiftCardMethod::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Gift Card method deleted successfully.');
    }

    // Store Bank Transfer Method
    public function storeBank(Request $request)
    {
        $request->validate([
            'method' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'detail' => 'required|string'
        ]);

        BankTransferMethod::create([
            'method' => $request->input('method'),
            'slug' => Str::slug($request->input('method')),
            'name' => $request->name,
            'detail' => $request->detail
        ]);

        return redirect()->back()->with('success', 'Bank Transfer method added successfully.');
    }

    // Delete Bank Transfer Method
    public function destroyBank($id)
    {
        BankTransferMethod::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Bank Transfer method deleted successfully.');
    }
}
