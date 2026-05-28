<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;
use domain\Facades\WalletFacade;
use domain\Facades\TransactionFacade;
use Illuminate\Support\Facades\Config;

class DashboardController extends Controller
{
    public function index()
    {
        try {

            $transactions = TransactionFacade::userLatestTransaction();
            $currencies = Config::get('currency.currency_list_for_api');
            $wallets = WalletFacade::all();
            $recentWalletId = WalletFacade::recentWallet()->id;

            $alltransactions = TransactionFacade::all();
            $totalCount = $alltransactions->count();
            $totalWalletCount = $wallets->count();

            $currentMonth = now()->format('Y-m');
            $totalExpenseAmount = TransactionFacade::userTotalAmountInWalletByCategory(0, 'expense', $currentMonth);
            $totalIncomeAmount = TransactionFacade::userTotalAmountInWalletByCategory(0, 'income', $currentMonth);
            $totalExpenseAmountAll = TransactionFacade::userTotalAmountInWalletByCategory(0, 'expense');
            $totalIncomeAmountAll = TransactionFacade::userTotalAmountInWalletByCategory(0, 'income');

            return view('pages.user.dashboard.index', compact('transactions','currencies','wallets','recentWalletId','totalExpenseAmount','totalIncomeAmount','totalCount','totalWalletCount','totalExpenseAmountAll','totalIncomeAmountAll'));
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
