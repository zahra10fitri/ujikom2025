<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    //
      protected $table = 'produks';
     protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_kategori',
        'id_toko',
        'nama_produk',
        'harga',
        'stok',
        'deskripsi',
        'tanggal_upload',
    ];

    // relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // relasi ke toko
    public function toko()
    {
        return $this->belongsTo(Toko::class, 'id_toko', 'id_toko');
    }

    // produk punya banyak gambar
   public function gambar_produk()
    {
        return $this->hasMany(Gambar_produk::class, 'id_produk', 'id_produk');
    }

}
