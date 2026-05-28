<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'wallet_id', 'category_id', 'category_type', 'title', 'description', 'amount', 'currency', 'exchange_rate', 'wallet_currency_amount', 'transaction_date', 'image_path'];

    protected $appends = [
        'category',
        'image_url',
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

    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        } else {
            return null;
        }
    }
}
