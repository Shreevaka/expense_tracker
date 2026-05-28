<?php

namespace domain\Services;

use App\Models\Wallet;

class WalletService
{
    protected $wallet;

    public function __construct()
    {
        $this->wallet = new Wallet();
    }

    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        return $this->wallet->where('user_id', auth()->id())->get();
    }

    public function allWallets()
    {
        return $this->wallet->get();
    }

    public function recentWallet()
    {
        return $this->wallet->where('user_id', auth()->id())->latest('updated_at')->first();
    }

    public function allWithParamAndPaginate($data, $limit = 10)
    {
        if($data && array_key_exists('sr', $data)){
            return $this->wallet->where('user_id', auth()->id())->where('name', 'LIKE', '%'.$data['sr'].'%')->orderBy('name')->paginate($limit);
        } else {
            return $this->wallet->where('user_id', auth()->id())->orderBy('name')->paginate($limit);
        }
    }

    public function allActive()
    {
        return $this->wallet->where('user_id', auth()->id())->where('is_active', 1)->get();
    }

    public function activeCount()
    {
        return $this->wallet->where('user_id', auth()->id())->where('is_active', 1)->count();
    }

    public function deactiveCount()
    {
        return $this->wallet->where('user_id', auth()->id())->where('is_active', 0)->count();
    }

    public function totalBalance()
    {
        return $this->wallet->where('user_id', auth()->id())->where('is_active', 1)->sum('current_balance');
    }

    public function first()
    {
        return $this->wallet->where('user_id', auth()->id())->first();
    }

    public function userWalletByWalletId($walletId)
    {
        $wallet = $this->wallet->where('id', $data['wallet_id'])
            ->where('user_id', auth()->id())
            ->first();

        return $wallet;
    }

    /**
     * get
     *
     * @param  mixed $product_id
     * @return void
     */
    public function get($id)
    {
        return $this->wallet->find($id);
    }

    public function store($data)
    {
        $wallet = $this->wallet->create([
            'user_id' => auth()->id(),
            'name' => $data['name'],
            'description' => $data['description'],
            'currency' => $data['currency'],
            'initial_balance' => $data['initial_balance'],
            'current_balance' => $data['initial_balance'],
        ]);
    }

    public function update($id, $data)
    {
        $this->get($id)->update($data);
    }

    public function updateWalletBalance($walletId, $type = 'income', $amount)
    {
        $wallet = $this->get($walletId);

        if ($type == 'income') {
            $wallet->current_balance += $amount;
        } elseif ($type == 'expense') {
            $wallet->current_balance -= $amount;
        }
        $wallet->save();
    }

    public function updateWalletBalanceForDelete($walletId, $type = 'income', $amount)
    {
        $wallet = $this->get($walletId);

        if ($type == 'income') {
            $wallet->current_balance -= $amount;
        } elseif ($type == 'expense') {
            $wallet->current_balance += $amount;
        }
        $wallet->save();
    }


    public function destroy($id)
    {
        $this->get($id)->delete();
    }

    public function updateWalletStatus($data)
    {
        $row = $this->get($data['id']);

        if ($row) {
            $row->is_active = $data['status'];
            $row->save();
        }
    }
}
