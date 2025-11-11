<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    
    protected $table = 'kategoris'; // pastikan nama tabel sesuai
    protected $primaryKey = 'id_kategori'; // kolom primary key di DB

    protected $fillable = ['nama_kategori'];
      // Kategori punya banyak produk
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kategori', 'id_kategori');
    }
}
