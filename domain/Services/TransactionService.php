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

    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        return $this->transaction->all();
    }

    public function allWithParamAndPaginate($data, $limit = 10)
    {
        $query = $this->transaction
            ->where('user_id', auth()->id());

        if (!empty($data['sr'])) {
            $query->where('title', 'LIKE', '%' . $data['sr'] . '%');
        }

        if (!empty($data['date'])) {
            $query->whereDate('transaction_date', $data['date']);
        }

        return $query
            ->orderByDesc('transaction_date')
            ->paginate($limit);
    }

    public function first()
    {
        return $this->transaction->first();
    }

    /**
     * get
     *
     * @param  mixed $product_id
     * @return void
     */
    public function get($id)
    {
        return $this->transaction->find($id);
    }

    public function store($data)
    {
        if ($data['type'] == 'expense') {
            $categoryType = 'App\Models\ExpenseCategory';
        } elseif ($data['type'] == 'income') {
            $categoryType = 'App\Models\IncomeCategory';
        }
        
        $transaction = $this->transaction->create([
            'user_id' => auth()->id(),
            'title' => $data['title'],
            'wallet_id' => $data['wallet_id'],
            'category_type' => $categoryType,
            'category_id' => $data['category_id'],
            'amount' => $data['amount'],
            'currency' => $data['currency'],
            'exchange_rate' => $data['exchange_rate'],
            'wallet_currency_amount' => $data['wallet_currency_amount'],
            'transaction_date' => $data['transaction_date'],
            'description' => $data['description'],
            'image_path' => $data['image_path'] ?? null,
        ]);
    }

    public function update($id, $data)
    {
        $this->get($id)->update($data);
    }

    public function destroy($id)
    {
        $this->get($id)->delete();
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

        $query = $this->transaction
        ->where('user_id', auth()->id())
        ->where('category_type', $categoryType);

        if ($walletId != 0) {
            $query->where('wallet_id', $walletId);
        }

        return $query->sum('wallet_currency_amount');
        
    }

    public function userLatestTransaction($limit = 5)
    {
        return $this->transaction->where('user_id', auth()->id())->latest('transaction_date')->limit($limit)->get();
    }

    public function walletTransactionWithPaginate($walletId, $limit=10)
    {
        $transactions = $this->transaction->where('wallet_id', $walletId)->paginate($limit);

        return $transactions;
    }
}
