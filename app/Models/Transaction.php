<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $appends = [
        'category',
    ];

    public function category()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function getCategoryAttribute()
    {
        $category = null;

        if ($this->category_type == 'App\Models\ExpenseCategory') {
            $category = 'expense';
        }elseif ($this->category_type == 'App\Models\IncomeCategory') {
            $category = 'income';
        }

        return $category;
    }
}
