<?php

namespace domain\Services;

use App\Models\User;

class UserService
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        return $this->user->all();
    }

    public function allWithParamAndPaginate($data, $limit = 10)
    {
        if($data && array_key_exists('sr', $data)){
            return $this->user->role('user')->where(function ($query) use ($data) {
                        $query->where('name', 'LIKE', "%{$data['sr']}%")
                        ->orWhere('email', 'LIKE', "%{$data['sr']}%");
                    })->orderBy('name')->paginate($limit);
        } else {
            return $this->user->role('user')->orderBy('name')->paginate($limit);
        }
    }

    public function allActive()
    {
        return $this->user->where('is_active', 1)->get();
    }

    public function activeCount()
    {
        return $this->user->where('is_active', 1)->count();
    }

    public function deactiveCount()
    {
        return $this->user->where('is_active', 0)->count();
    }

    public function first()
    {
        return $this->user->first();
    }

    /**
     * get
     *
     * @param  mixed $product_id
     * @return void
     */
    public function get($id)
    {
        return $this->user->find($id);
    }

    public function updateUserStatus($data)
    {
        $row = $this->get($data['id']);

        if ($row) {
            $row->is_active = $data['status'];
            $row->save();
        }
    }
}
