<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Toko;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Gambar_produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
         User::create([
            'nama' => 'zahra',
            'kontak' => '0812345678901',
            'username' => 'zahra',
            'password' => bcrypt('123'),
            'role' => 'admin',
        ]);

        User::create([
            'nama' => 'tiara',
            'kontak' => '0812345678901',
            'username' => 'tiara',
            'password' => bcrypt('123'),
            'role' => 'member',
        ]);


          Toko::create([
            'nama_toko' => 'warung gaul',
            'deskripsi' => 'warung gaul menjual makanan yang gaul dan kekinian.',
            'gambar' => 'storage/images/toko1.jpg',
            'kontak_toko' => '081234567890',
            'alamat' => 'Samping koperasi sekolah',
            'user_id' => 2,
        ]);

        Kategori::create(['nama_kategori' => 'makanan manis']);
        Kategori::create(['nama_kategori' => 'Minuman']);
        Kategori::create(['nama_kategori' => 'makanan pedas']);
        Kategori::create(['nama_kategori' => 'snack']);
        Kategori::create(['nama_kategori' => 'gorengan']);
        Kategori::create(['nama_kategori' => 'roti']);

           Produk::create([
               'id_kategori' => 6,
               'nama_produk' => 'Roti Coklat',
               'harga' => 5000,
               'stok' => 50,
               'deskripsi' => 'Roti lembut isi coklat favorit anak sekolah.',
               'tanggal_upload' => now(),
               'id_toko' => 1,                       
        ]);

        Gambar_produk::create([
            'id_produk' => 1,
            'nama_gambar' => 'roti coklat',
        ]);
    }
}
