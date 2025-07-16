<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'payment_id';
    public $incrementing = false;

    protected $fillable = ['payment_id', 'cart_id', 'amount', 'payment_method', 'status', 'paid_at'];
    
    public function cart() {
        return $this->belongsTo(Cart::class);
    }
}
