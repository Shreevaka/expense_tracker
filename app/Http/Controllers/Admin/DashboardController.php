<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;
use domain\Facades\UserFacade;
use domain\Facades\WalletFacade;
use domain\Facades\TransactionFacade;

class DashboardController extends Controller
{
    public function index()
    {
        try {

            $allUsers = UserFacade::allUsers();
            $totalCount = $allUsers->count();

            $allWallets = WalletFacade::allWallets();
            $totaleWallets = $allWallets->count();

            $alltransactions = TransactionFacade::all();
            $totaltransactions = $alltransactions->count();

            return view('pages.admin.dashboard.index', compact('totalCount','totaleWallets','totaltransactions'));
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
