<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected $fillable = [
        'media',
        'tanggal_laporan',
        'deskripsi',
        'status_laporan',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
