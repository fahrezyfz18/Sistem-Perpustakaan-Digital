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
        /*
        |--------------------------------------------------------------------------
        | HAPUS KOLOM LAMA
        |--------------------------------------------------------------------------
        */

        Schema::table('peminjaman', function (Blueprint $table) {

            if (Schema::hasColumn('peminjaman', 'nama')) {
                $table->dropColumn('nama');
            }

            if (Schema::hasColumn('peminjaman', 'judul')) {
                $table->dropColumn('judul');
            }

            if (Schema::hasColumn('peminjaman', 'tgl_pinjam')) {
                $table->dropColumn('tgl_pinjam');
            }

            if (Schema::hasColumn('peminjaman', 'tgl_kembali')) {
                $table->dropColumn('tgl_kembali');
            }

        });


        /*
        |--------------------------------------------------------------------------
        | TAMBAH KOLOM BARU
        |--------------------------------------------------------------------------
        */

        Schema::table('peminjaman', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | USER ID
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('peminjaman', 'user_id')) {

                $table->foreignId('user_id')
                    ->after('id')
                    ->constrained()
                    ->cascadeOnDelete();

            }

            /*
            |--------------------------------------------------------------------------
            | BOOK ID
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('peminjaman', 'book_id')) {

                $table->foreignId('book_id')
                    ->after('user_id')
                    ->constrained('books')
                    ->cascadeOnDelete();

            }

            /*
            |--------------------------------------------------------------------------
            | TANGGAL PINJAM
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('peminjaman', 'tanggal_pinjam')) {

                $table->date('tanggal_pinjam');

            }

            /*
            |--------------------------------------------------------------------------
            | TANGGAL KEMBALI
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('peminjaman', 'tanggal_kembali')) {

                $table->date('tanggal_kembali')
                    ->nullable();

            }

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('peminjaman', 'status')) {

                $table->enum('status', [
                    'dipinjam',
                    'dikembalikan'
                ])->default('dipinjam');

            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | DROP FOREIGN KEY
            |--------------------------------------------------------------------------
            */

            if (Schema::hasColumn('peminjaman', 'user_id')) {

                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');

            }

            if (Schema::hasColumn('peminjaman', 'book_id')) {

                $table->dropForeign(['book_id']);
                $table->dropColumn('book_id');

            }

            /*
            |--------------------------------------------------------------------------
            | DROP COLUMN BARU
            |--------------------------------------------------------------------------
            */

            if (Schema::hasColumn('peminjaman', 'tanggal_pinjam')) {
                $table->dropColumn('tanggal_pinjam');
            }

            if (Schema::hasColumn('peminjaman', 'tanggal_kembali')) {
                $table->dropColumn('tanggal_kembali');
            }

        });
    }
};