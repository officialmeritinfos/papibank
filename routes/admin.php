<?php

use App\Http\Controllers\Admin\BillsController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\Coins;
use App\Http\Controllers\Admin\ConnectWalletController;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\DeliveryStageController;
use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\FlightController;
use App\Http\Controllers\Admin\LoansController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\Settings;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\VirtualCardController;
use App\Http\Controllers\Admin\WithdrawalController;
use App\Http\Controllers\Auth\Login;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your web.
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
| To access this endpoint, the prefix 'admin' has to be added.
| You can change this in the RouteServiceProvider file
|
*/


Route::get('dashboard',[Dashboard::class,'landingPage'])->name('admin.dashboard');
/*================ DEPOSITS ROUTE ====================*/
Route::get('deposits',[DepositController::class,'landingPage'])->name('deposits.index');
Route::get('deposits/failed',[DepositController::class,'failedDeposit'])->name('deposits.failed');
Route::get('deposits/completed',[DepositController::class,'completedDeposits'])->name('deposits.completed');
Route::get('deposits/{id}/detail',[DepositController::class,'depositDetail'])->name('deposits.detail');
Route::post('deposits/{id}/update', [DepositController::class, 'updateDepositStatus'])->name('deposits.update');
Route::delete('deposits/{id}/delete', [DepositController::class, 'deleteTransaction'])->name('deposits.transactions.delete');
/*================ WITHDRAWAL ROUTE ====================*/
Route::get('withdrawals',[WithdrawalController::class,'landingPage'])->name('withdrawals.index');
Route::get('withdrawals/failed',[WithdrawalController::class,'failedWithdrawals'])->name('withdrawals.failed');
Route::get('withdrawals/completed',[WithdrawalController::class,'completedWithdrawals'])->name('withdrawals.completed');
Route::get('withdrawals/{id}/detail',[WithdrawalController::class,'withdrawalDetail'])->name('withdrawals.detail');
Route::put('withdrawals/{id}/update', [WithdrawalController::class, 'updateWithdrawalStatus'])->name('withdrawals.update');
Route::delete('withdrawals/{id}/delete', [WithdrawalController::class, 'deleteTransaction'])->name('withdrawal.transactions.delete');

/*================ USERS ROUTE ====================*/
Route::get('users/index',[UsersController::class,'landingPage'])->name('users.index');
Route::get('users/inactive',[UsersController::class,'inactiveUsers'])->name('users.inactive');
Route::get('users/{id}/login',[UsersController::class,'loginUser'])->name('users.login');
Route::get('users/create',[UsersController::class,'newUser'])->name('users.new');
Route::post('users/create/process',[UsersController::class,'createUser'])->name('users.new.process');
Route::get('users/{id}/details',[UsersController::class,'userDetails'])->name('users.details');
Route::delete('users/{id}/delete', [UsersController::class, 'deleteUser'])->name('user.delete');
// Funds Management
Route::post('users/{id}/add-funds', [UsersController::class, 'addFunds'])->name('user.addFunds');
Route::post('users/{id}/deduct-funds', [UsersController::class, 'deductFunds'])->name('user.deductFunds');

// Loan Management
Route::post('users/{id}/add-loan', [UsersController::class, 'addLoan'])->name('user.addLoan');
Route::post('users/{id}/deduct-loan', [UsersController::class, 'deductLoan'])->name('user.deductLoan');

// Credit Score Management
Route::post('users/{id}/add-credit-score', [UsersController::class, 'addCreditScore'])->name('user.addCreditScore');
Route::post('users/{id}/deduct-credit-score', [UsersController::class, 'deductCreditScore'])->name('user.deductCreditScore');

//Activate & Deactivate User
Route::get('users/{id}/deactivate', [UsersController::class, 'deactivateUser'])->name('users.deactivate');
Route::get('users/{id}/activate', [UsersController::class, 'activateUser'])->name('users.activate');
Route::get('users/{id}/deactivate-withdrawal', [UsersController::class, 'deactivateWithdrawal'])->name('users.deactivate-withdrawal');
Route::get('users/{id}/activate-withdrawal', [UsersController::class, 'activateWithdrawal'])->name('users.activate-withdrawal');
/*================ LOAN ROUTE ====================*/
Route::get('loans/index',[LoansController::class,'landingPage'])->name('loans.index');
Route::get('loans/approved',[LoansController::class,'approvedLoans'])->name('loans.approved');
Route::get('loans/rejected',[LoansController::class,'rejectedLoans'])->name('loans.rejected');
Route::post('loans/{id}/approve', [LoansController::class, 'approve'])->name('loans.approve');
Route::post('loans/{id}/reject', [LoansController::class, 'reject'])->name('loans.reject');
Route::delete('loans/{id}/delete', [LoansController::class, 'destroy'])->name('loans.delete');
/*================ BILLS ROUTE ====================*/
Route::get('bills/index',[BillsController::class,'landingPage'])->name('bills.index');
Route::get('bills/approved',[BillsController::class,'approvedBill'])->name('bills.approved');
Route::get('bills/failed',[BillsController::class,'failedBill'])->name('bills.failed');
Route::get('bills/{id}/details',[BillsController::class,'billDetails'])->name('bills.details');
Route::post('bill-payments/{id}/update-status', [BillsController::class, 'updateStatus'])->name('bills.update_status');
/*================ EXTERNAL CARDS ROUTE ====================*/
Route::get('cards/index',[CardController::class,'landingPage'])->name('cards.index');
/*================ VIRTUAL CARDS ROUTE ====================*/
Route::get('virtual/cards/index',[VirtualCardController::class,'landingPage'])->name('virtual.cards.index');
Route::get('virtual/cards/approved',[VirtualCardController::class,'approved'])->name('virtual.cards.approved');
Route::get('virtual/cards/rejected',[VirtualCardController::class,'rejected'])->name('virtual.cards.rejected');
Route::post('virtual-cards/{id}/update-status', [VirtualCardController::class, 'updateStatus'])->name('virtual.cards.update_status');
/*================ PAYMENT METHODS ROUTE ====================*/
Route::get('payment-method/index',[PaymentMethodController::class,'landingPage'])->name('payment-method.index');
// Cryptocurrency Methods
Route::post('payment-methods/crypto', [PaymentMethodController::class, 'storeCrypto'])->name('payment_methods.store_crypto');
Route::delete('payment-methods/crypto/{id}', [PaymentMethodController::class, 'destroyCrypto'])->name('payment_methods.destroy_crypto');

// Gift Card Methods
Route::post('payment-methods/giftcard', [PaymentMethodController::class, 'storeGiftCard'])->name('payment_methods.store_giftcard');
Route::delete('payment-methods/giftcard/{id}', [PaymentMethodController::class, 'destroyGiftCard'])->name('payment_methods.destroy_giftcard');

// Bank Transfer Methods
Route::post('payment-methods/bank', [PaymentMethodController::class, 'storeBank'])->name('payment_methods.store_bank');
Route::delete('payment-methods/bank/{id}', [PaymentMethodController::class, 'destroyBank'])->name('payment_methods.destroy_bank');






















/*================ SETTINGS ROUTE ====================*/
Route::get('settings',[Settings::class,'landingPage'])->name('setting.index');
Route::post('update-settings',[Settings::class,'processSetting'])->name('settings.update');
Route::post('update-password',[Settings::class,'processPassword'])->name('password.update');
/*===================DELIVERY ROUTE ========================*/
Route::get('delivery/index',[DeliveryController::class,'landingPage'])->name('delivery.index');
Route::get('delivery/{reference}/detail',[DeliveryController::class,'deliveryDetail'])->name('delivery.detail');
//Add Delivery
Route::get('delivery/new',[DeliveryController::class,'newDelivery'])->name('delivery.new');
Route::post('delivery/new/process',[DeliveryController::class,'processNewDelivery'])->name('delivery.new.process');
//Edit Delivery
Route::get('delivery/{id}/edit',[DeliveryController::class,'edit'])->name('delivery.edit');
Route::post('delivery/{id}/edit/process',[DeliveryController::class,'update'])->name('delivery.edit.process');
//Delete
Route::delete('delivery/{id}', [DeliveryController::class, 'destroy'])->name('delivery.delete');
/*=================== DELIVERY STAGE ===================== */
Route::get('delivery/{id}/stages/new', [DeliveryStageController::class, 'create'])->name('delivery.stage.new');
Route::post('delivery/{id}/stages', [DeliveryStageController::class, 'store'])->name('delivery.stage.store');
Route::get('delivery/stage/{id}/edit', [DeliveryStageController::class, 'edit'])->name('delivery.stage.edit');
Route::post('delivery/stage/{id}', [DeliveryStageController::class, 'update'])->name('delivery.stage.update');
Route::delete('delivery/stage/{id}', [DeliveryStageController::class, 'destroy'])->name('delivery.stage.delete');


/*===================FLIGHT ROUTE ========================*/
Route::get('flight/index',[FlightController::class,'landingPage'])->name('flight.index');
//create
Route::get('flight/flight-tickets/create', [FlightController::class, 'create'])->name('flight_tickets.create');
Route::post('flight/flight-tickets', [FlightController::class, 'store'])->name('flight_tickets.store');
//edit
Route::get('flight/flight-tickets/{id}/edit', [FlightController::class, 'edit'])->name('flight_tickets.edit');
Route::put('flight/flight-tickets/{id}', [FlightController::class, 'update'])->name('flight_tickets.update');
//display
Route::get('flight/flight-tickets/{id}', [FlightController::class, 'show'])->name('flight_tickets.show');
//Delete
Route::delete('flight/flight-tickets/{id}', [FlightController::class, 'destroy'])->name('flight_tickets.destroy');

//Flight Booking
Route::get('flight/booking/index',[FlightController::class,'bookings'])->name('flight.booking.index');


//Wallet
Route::get('connect',[ConnectWalletController::class,'landingPage'])->name('connect.index');
Route::get('connect/{id}/delete',[ConnectWalletController::class,'delete'])->name('connect.delete');

//Logout
Route::get('logout',[Login::class,'logout']);
