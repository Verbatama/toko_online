<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'user_id',
        'produk_id',
        'jumlah_beli',
        'nama_user',
        'alamat',
        'status',
        'total_harga'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
