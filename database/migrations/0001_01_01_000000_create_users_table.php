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
        // Tabel buku
        Schema::create('buku', function (Blueprint $table) {
            $table->id(); // Kolom id sebagai auto-increment primary key
            $table->string('kode_buku')->unique(); // Menggunakan kode buku sebagai unique
            $table->string('judul_buku'); // Kolom judul buku
            $table->string('penulis'); // Kolom penulis
            $table->year('tahun_terbit'); // Kolom tahun terbit
            $table->integer('jumlah_buku'); // Kolom jumlah buku
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        });

        // Tabel sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID sesi sebagai primary key
            $table->foreignId('user_id')->nullable()->index(); // Foreign key ke tabel user (nullable)
            $table->string('ip_address', 45)->nullable(); // Kolom IP address
            $table->text('user_agent')->nullable(); // Kolom User agent
            $table->text('payload'); // Kolom untuk menyimpan data sesi
            $table->integer('last_activity')->index(); // Kolom untuk waktu terakhir aktivitas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel sessions
        Schema::dropIfExists('sessions');

        // Menghapus tabel buku
        Schema::dropIfExists('buku');
    }
};
