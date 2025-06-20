<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihan';

    protected $fillable = [
        'user_id',
        'tanggal_tagihan',
        'jumlah_tagihan',
        'status_pembayaran',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
