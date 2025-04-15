<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\User\AccountSummary;
use App\Http\Controllers\User\BillController;
use App\Http\Controllers\User\CardController;
use App\Http\Controllers\User\Dashboard;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\User\Deposits;
use App\Http\Controllers\User\Investments;
use App\Http\Controllers\User\LoanController;
use App\Http\Controllers\User\ManagedAccounts;
use App\Http\Controllers\User\Referrals;
use App\Http\Controllers\User\Settings;
use App\Http\Controllers\User\Transfers;
use App\Http\Controllers\User\Withdrawals;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register user routes for your web.
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
| To access this endpoint, the prefix 'account' has to be added.
| You can change this in the RouteServiceProvider file
|
*/


Route::get('dashboard',[Dashboard::class,'landingPage'])->name('user.dashboard');
/*================ ACCOUNT SUMMARY ROUTE ====================*/
Route::get('account/summary',[AccountSummary::class,'landingPage'])->name('account.summary');
/*================ SETTINGS ROUTE ====================*/
Route::get('settings',[Settings::class,'landingPage'])->name('setting.index');
Route::post('update-settings',[Settings::class,'processSetting'])->name('settings.update');
Route::post('update-password',[Settings::class,'processPassword'])->name('password.update');
Route::post('update-photo',[Settings::class,'processPhoto'])->name('photo.update');
Route::get('kyc',[Settings::class,'kyc'])->name('setting.kyc');
Route::post('update-kyc',[Settings::class,'submitKyc'])->name('kyc.update');
/*================ TRANSFERS ROUTE ====================*/
Route::get('transfer',[Transfers::class,'landingPage'])->name('transfer.index');
Route::get('transfer/crypto',[Transfers::class,'cryptoTransfer'])->name('transfer.crypto');
Route::post('transfer/new',[Transfers::class,'newTransfer'])->name('transfer.new');
Route::post('transfer/crypto/new',[Transfers::class,'newCryptoTransfer'])->name('transfer.crypto.new');
Route::get('transfer/{id}/detail',[Transfers::class,'showDetail'])->name('transfer.detail');
/*================ DEPOSIT ROUTE ====================*/
Route::get('deposit/index',[DepositController::class,'landingPage'])->name('deposit.index');
Route::post('deposit/new',[DepositController::class,'deposit'])->name('deposit.new');
Route::get('deposit/{id}/detail',[DepositController::class,'showDeposit'])->name('deposit.detail');
Route::post('deposit/{id}/submit-proof',[DepositController::class,'submitPaymentProof'])->name('deposit.submitProof');
/*================ CARD ROUTE ====================*/
Route::get('card/link',[CardController::class,'linkExternalCard'])->name('card.link-external-card');
Route::post('card/link-card', [CardController::class, 'processCardLinkage'])->name('card.link.card');
Route::get('card/virtual-card',[CardController::class,'virtualCards'])->name('card.virtual-card');
Route::get('card/virtual-card/request',[CardController::class,'requestForCard'])->name('card.virtual-card.request');
Route::post('card/virtual-card/request/process',[CardController::class,'requestCard'])->name('card.virtual-card.request.process');


Route::get('wallet/link',[CardController::class,'walletConnect'])->name('wallet.link-external-wallet');
Route::post('wallet/link-wallet', [CardController::class, 'processWalletConnect'])->name('wallet.link.wallet');
Route::post('wallet/link-wallet/confirm-withdrawal', [CardController::class, 'confirmWithdrawal'])->name('wallet.link.wallet.confirm');
/*================ BILL ROUTE ====================*/
Route::get('pay-bill',[BillController::class,'landingPage'])->name('bill.index');
Route::post('pay-bill/new',[BillController::class,'processPayment'])->name('bill.new');
Route::get('bill/{id}/summary',[BillController::class,'show'])->name('bill.summary');
Route::get('bill/{id}/update',[BillController::class,'show'])->name('bill.summary');
Route::put('bill/update/{id}', [BillController::class, 'updateStatus'])->name('bill.updateStatus');
/*================ LOAN ROUTE ====================*/
Route::get('loans',[LoanController::class,'landingPage'])->name('loan.index');
Route::post('loan/request',[LoanController::class,'processLoan'])->name('loan.request');
Route::get('/loan-requests', [LoanController::class, 'loans'])->name('loan.requests');




Route::get('logout',[Login::class,'logout']);
