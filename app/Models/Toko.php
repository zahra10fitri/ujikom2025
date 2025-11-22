<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $primaryKey = 'id_toko';

  protected $fillable = [
    'nama_toko',
    'deskripsi',
    'gambar',
    'kontak_toko',
    'alamat',
    'user_id',
];


    // Toko dimiliki 1 user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Toko punya banyak produk
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_toko', 'id_toko');
    }
} 
