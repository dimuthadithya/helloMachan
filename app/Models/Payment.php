<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'card_number',
        'card_holder_name',
        'expiration_month',
        'expiration_year',
        'cvv',
        'amount',
        'status',
        'payment_method',
        'transaction_id',
        'payment_details'
    ];

    protected $hidden = [
        'cvv',
    ];

    protected $casts = [
        'payment_details' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
