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
            'status' => 'approved',
        ]);

        User::create([
            'nama' => 'tiara',
            'kontak' => '0812345678901',
            'username' => 'tiara',
            'password' => bcrypt('123'),
            'role' => 'member',
            'status' => 'approved',
        ]);

         User::create([
            'nama' => 'ara',
            'kontak' => '0812345678901',
            'username' => 'ara',
            'password' => bcrypt('123'),
            'role' => 'member',
            'status' => 'pending',
        ]);

    }
}
