<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tokos', function (Blueprint $table) {
          $table->id('id_toko');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_toko');
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->string('kontak_toko');
            $table->string('alamat');
            $table->timestamps();

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokos');
    }
};
