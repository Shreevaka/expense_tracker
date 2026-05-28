<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;
use domain\Facades\WalletFacade;
use domain\Facades\TransactionFacade;
use domain\Facades\ExpenseCategoryFacade;
use domain\Facades\IncomeCategoryFacade;
use domain\Facades\ImageFacade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $transactions = TransactionFacade::allWithParamAndPaginate($request->all());

            $alltransactions = TransactionFacade::all();
            $totalCount = $alltransactions->count();
            $totalExpenseAmount = TransactionFacade::userTotalAmountInWalletByCategory(0, 'expense');
            $totalIncomeAmount = TransactionFacade::userTotalAmountInWalletByCategory(0, 'income');
            $currencies = Config::get('currency.currency_list_for_api');
            $wallets = WalletFacade::all();

            return view('pages.user.transaction.index', compact('transactions','totalCount','totalExpenseAmount','totalIncomeAmount','currencies','wallets'));
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
        DB::beginTransaction();
        try {

            $wallet = WalletFacade::get($request->wallet_id);

            if (!$wallet) {
                return redirect()->back()->with('error', 'You do not have access.');
            }

            if ($request->image) {
                $imagePath = ImageFacade::store($request->image, 'transactions');

                $request->merge(['image_path' => $imagePath]);
            }

            $category = null;

            if ($request->type == 'expense') {
                $category = ExpenseCategoryFacade::get($request->category_id);

            } elseif ($request->type == 'income') {
                $category = IncomeCategoryFacade::get($request->category_id);
            } else {
                return redirect()->back()->with('error', 'Invalid category type.');
            }

            if (!$category) {
                return redirect()->back()->with('error', 'Category not found.');
            }

            $walletCurrency = $wallet->currency;
            $requestCurrency = $request->currency;
            $exchangeRate = 1;
            $walletAmount = $request->amount;

            // if ($walletCurrency != $requestCurrency) {

                // $response = Http::get(
                //     "http://api.exchangeratesapi.io/v1/latest",
                //     [
                //         'access_key' => Config::get('currency.exchange_rate_api_key'),
                //         'base' => $requestCurrency, //EUR only available for free plan
                //         'symbols' => $walletCurrency,
                //     ]
                // );

                // $data = $response->json();

                // $exchangeRate = $data['rates'][$walletCurrency];

                // $walletAmount = $request->amount * $exchangeRate;
            // }

            $request->merge(['exchange_rate' => $exchangeRate, 'wallet_currency_amount' => $walletAmount]);

            TransactionFacade::store($request->all());

            WalletFacade::updateWalletBalance($wallet->id, $request->type, $walletAmount);

            DB::commit();

            return redirect()->route('user.transactions.index')->with('success', 'Transaction Added Successfully');

        } catch (Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {

            $transaction = TransactionFacade::get($id);

            if (!$transaction) {
                return json_encode([
                    'response' => 'error',
                    'message' => 'Transaction not found!'
                ]);
            }

            // determine type
            if ($transaction->category_type == 'App\Models\IncomeCategory') {
                $categoryType = 'income';
            } else {
                $categoryType = 'expense';
            }

            WalletFacade::updateWalletBalanceForDelete(
                $transaction->wallet_id,
                $categoryType,
                $transaction->wallet_currency_amount
            );

            TransactionFacade::destroy($id);

            DB::commit();

            return json_encode([
                'response' => 'success',
                'message' => 'Transaction Deleted Successfully!'
            ]);

        } catch (Throwable $th) {

            DB::rollBack();

            return json_encode([
                'response' => 'error',
                'message' => 'Something went wrong'
            ]);
        }
    }

    public function getCategoryByType(Request $request)
    {
        if ($request->type == 'expense') {
            $categories = ExpenseCategoryFacade::allActive();
            return $categories;
        }

        if ($request->type == 'income') {
            $categories = IncomeCategoryFacade::allActive();
            return $categories;
        }

        return [];
    }
}
