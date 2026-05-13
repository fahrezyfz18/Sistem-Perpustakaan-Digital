<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | DEADLINE
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('peminjaman', 'deadline')) {

                $table->date('deadline')
                    ->nullable()
                    ->after('tanggal_pinjam');

            }

            /*
            |--------------------------------------------------------------------------
            | TANGGAL DIKEMBALIKAN
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('peminjaman', 'tanggal_dikembalikan')) {

                $table->date('tanggal_dikembalikan')
                    ->nullable()
                    ->after('deadline');

            }

            /*
            |--------------------------------------------------------------------------
            | HAPUS TANGGAL_KEMBALI LAMA
            |--------------------------------------------------------------------------
            */

            if (Schema::hasColumn('peminjaman', 'tanggal_kembali')) {

                $table->dropColumn('tanggal_kembali');

            }

        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | HAPUS KOLOM BARU
            |--------------------------------------------------------------------------
            */

            if (Schema::hasColumn('peminjaman', 'deadline')) {

                $table->dropColumn('deadline');

            }

            if (Schema::hasColumn('peminjaman', 'tanggal_dikembalikan')) {

                $table->dropColumn('tanggal_dikembalikan');

            }

            /*
            |--------------------------------------------------------------------------
            | KEMBALIKAN KOLOM LAMA
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('peminjaman', 'tanggal_kembali')) {

                $table->date('tanggal_kembali')
                    ->nullable();

            }

        });
    }
};