<?php

// app/Models/Payment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'tagihan_id',
        'user_id',
        'snap_token',
        'order_id',
        'payment_type',
        'transaction_id',
        'paid_at'
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withoutTrashed();
    }
}