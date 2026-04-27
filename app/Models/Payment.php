<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'amount',
        'method',
        'status',
        'transaction_id',
        'payer_email' 
    ];

    // ✅ Add this relationship
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}