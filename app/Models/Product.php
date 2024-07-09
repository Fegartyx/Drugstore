<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function history()
    {
        return $this->belongsTo(HistoryTransaction::class);
    }

    public function historyTransaction()
    {
        return $this->hasMany(HistoryTransaction::class, 'product_id');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
        // return $this->belongsTo(Cart::class);
    }
}
