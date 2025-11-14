<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gambar_produk extends Model
{
    //
      protected $table = 'gambar_produks';
     protected $primaryKey = 'id_gambar';

     protected $fillable = [
        'id_produk',
        'nama_gambar',
    ];

    // relasi ke produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

}
