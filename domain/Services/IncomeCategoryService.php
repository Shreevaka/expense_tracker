<?php

namespace domain\Services;

use App\Models\IncomeCategory;

class IncomeCategoryService
{
    protected $incomeCategory;

    public function __construct()
    {
        $this->incomeCategory = new IncomeCategory();
    }

    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        return $this->incomeCategory->all();
    }

    public function allWithParamAndPaginate($data, $limit = 10)
    {
        if($data && array_key_exists('sr', $data)){
            return $this->incomeCategory->where('name', 'LIKE', '%'.$data['sr'].'%')->orderBy('name')->paginate($limit);
        } else {
            return $this->incomeCategory->orderBy('name')->paginate($limit);
        }
    }

    public function allActive()
    {
        return $this->incomeCategory->where('is_active', 1)->get();
    }

    public function activeCount()
    {
        return $this->incomeCategory->where('is_active', 1)->count();
    }

    public function deactiveCount()
    {
        return $this->incomeCategory->where('is_active', 0)->count();
    }

    public function first()
    {
        return $this->incomeCategory->first();
    }

    /**
     * get
     *
     * @param  mixed $product_id
     * @return void
     */
    public function get($id)
    {
        return $this->incomeCategory->find($id);
    }

    public function store($data)
    {
        $incomeCategory = $this->incomeCategory->create([
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

    public function updateIncomeCategoryStatus($data)
    {
        $row = $this->get($data['id']);

        if ($row) {
            $row->is_active = $data['status'];
            $row->save();
        }
    }
}
