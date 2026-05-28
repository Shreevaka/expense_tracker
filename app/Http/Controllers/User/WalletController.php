<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;
use domain\Facades\WalletFacade;
use domain\Facades\TransactionFacade;
use Illuminate\Support\Facades\Config;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $wallets = WalletFacade::allWithParamAndPaginate($request->all());

            $allWallets = WalletFacade::all();
            $totalCount = $allWallets->count();
            $activeCount = WalletFacade::activeCount();
            $totalBalance = WalletFacade::totalBalance();
            $currencies = Config::get('currency.currency_list');

            return view('pages.user.wallet.index', compact('wallets','totalCount','activeCount','totalBalance','currencies'));
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            WalletFacade::store($request->all());

            return redirect()->route('user.wallets.index')->with('success', 'Wallet Added Successfully');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $wallet = WalletFacade::get($id);

        if (!$wallet) {
            return redirect()
                ->back()
                ->with('error', 'Wallet not found.');
        }
        
        if ($wallet->user_id != auth()->id()) {
            return redirect()
                ->back()
                ->with('error', 'You do not have access.');
        }

        $totalCount = $wallet->transactions()->count();
        $totalExpense = TransactionFacade::userTotalAmountInWalletByCategory($id, 'expense');
        $transactions = TransactionFacade::walletTransactionWithPaginate($id);

        return view('pages.user.wallet.show', compact('wallet','totalCount','totalExpense','transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            WalletFacade::update($id, $request->all());

            return redirect()->route('user.wallets.index')->with('success', 'Wallet Updated Successfully');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            WalletFacade::destroy($id);

            return json_encode(array('response' => 'success', 'message' => 'Wallet Deleted Successfully!'));
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function updateWalletStatus(Request $request)
    {

        WalletFacade::updateWalletStatus($request->all());

        return response()->json([
            'status' => 'success',
            'message' =>  '',
        ]);
    }
}
