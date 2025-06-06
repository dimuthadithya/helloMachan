<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'payment_status',
        'payment_method',
        'delivery_address',
        'contact_number',
        'special_instructions',
        'completed_at',
        'customer_name',
        'customer_email',
        'customer_phone',
        'order_number'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'completed_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function feedback(): HasOne
    {
        return $this->hasOne(Feedback::class);
    }
}
