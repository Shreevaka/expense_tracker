<?php

namespace domain\Services;

use App\Models\ExpenseCategory;

class ExpenseCategoryService
{
    protected $expenseCategory;

    public function __construct()
    {
        $this->expenseCategory = new ExpenseCategory();
    }

    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        return $this->expenseCategory->all();
    }

    public function allWithParamAndPaginate($data, $limit = 10)
    {
        if($data && array_key_exists('sr', $data)){
            return $this->expenseCategory->where('name', 'LIKE', '%'.$data['sr'].'%')->orderBy('name')->paginate($limit);
        } else {
            return $this->expenseCategory->orderBy('name')->paginate($limit);
        }
    }

    public function allActive()
    {
        return $this->expenseCategory->where('is_active', 1)->get();
    }

    public function allActiveWithUserCount()
    {
        return $this->expenseCategory->where('is_active', 1)
            ->withCount(['transactions' => function ($query) {
                $query->where('user_id', auth()->id());
            }])
            ->orderByDesc('transactions_count')
            ->get();
    }

    public function activeCount()
    {
        return $this->expenseCategory->where('is_active', 1)->count();
    }

    public function deactiveCount()
    {
        return $this->expenseCategory->where('is_active', 0)->count();
    }

    public function first()
    {
        return $this->expenseCategory->first();
    }

    /**
     * get
     *
     * @param  mixed $product_id
     * @return void
     */
    public function get($id)
    {
        return $this->expenseCategory->find($id);
    }

    public function store($data)
    {
        $expenseCategory = $this->expenseCategory->create([
            'name' => $data['name'],
            'description' => $data['description'],
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

    public function updateExpenseCategoryStatus($data)
    {
        $row = $this->get($data['id']);

        if ($row) {
            $row->is_active = $data['status'];
            $row->save();
        }
    }
}
