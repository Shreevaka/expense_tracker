<?php

namespace domain\Services;

use App\Models\Transaction;
use App\Models\Wallet;

class TransactionService
{
    protected $transaction;

    public function __construct()
    {
        $this->transaction = new Transaction();
    }

    public function userTotalAmountInWalletByCategory($walletId, $category = 'expense')
    {
        if ($category == 'expense') {
            $categoryType = 'App\Models\ExpenseCategory';
        } elseif ($category == 'income') {
            $categoryType = 'App\Models\IncomeCategory';
        }else{
            return 0;
        }
        
        $amount = $this->transaction->where('user_id', auth()->id())->where('wallet_id', $walletId)->where('category_type', $categoryType)->sum('wallet_currency_amount');

        return $amount;
    }

    public function walletTransaction($walletId)
    {
        $transactions = $this->transaction->where('wallet_id', $walletId)->get();

        return $transactions;
    }

    public function walletTransactionWithPaginate($walletId, $limit=10)
    {
        $transactions = $this->transaction->where('wallet_id', $walletId)->paginate($limit);

        return $transactions;
    }
}
