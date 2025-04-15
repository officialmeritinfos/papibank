<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AccountTransaction;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountSummary extends Controller
{
    //landing page
    public function landingPage(Request $request)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $query = AccountTransaction::where('user_id', $user->id);

        // If there's a search term, filter transactions
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('transaction_id', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('transaction_type', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('amount', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('status', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('created_at', 'LIKE', "%{$searchTerm}%");
            });
        }

        $transactions = $query->orderBy('created_at', 'desc')->paginate(10);

        // If request is AJAX (for live search), return JSON response
        if ($request->ajax()) {
            return response()->json([
                'transactions' => view('user.partial.transactions_table', compact('transactions'))->render()
            ]);
        }

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Account Summary',
            'user'     =>  $user,
            'web'=>$web,
            'transactions' => $transactions,
        ];

        return view('user.account_summary',$dataView);
    }
}
