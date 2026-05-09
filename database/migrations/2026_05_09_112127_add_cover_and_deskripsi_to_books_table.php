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
        Schema::table('books', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | TAMBAH KOLOM COVER
            |--------------------------------------------------------------------------
            |
            | Untuk menyimpan path/nama gambar cover buku
            | Contoh:
            | books/cover123.jpg
            |
            */

            $table->string('cover')->nullable();


            /*
            |--------------------------------------------------------------------------
            | TAMBAH KOLOM DESKRIPSI
            |--------------------------------------------------------------------------
            |
            | Untuk menyimpan sinopsis/deskripsi buku
            |
            */

            $table->text('deskripsi')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | HAPUS KOLOM SAAT ROLLBACK
            |--------------------------------------------------------------------------
            */

            $table->dropColumn('cover');

            $table->dropColumn('deskripsi');

        });
    }
};