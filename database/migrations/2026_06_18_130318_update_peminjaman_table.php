<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {

            if (!Schema::hasColumn('peminjaman', 'tanggal_dikembalikan')) {
                $table->date('tanggal_dikembalikan')
                    ->nullable()
                    ->after('tgl_jatuh_tempo');
            }

            if (!Schema::hasColumn('peminjaman', 'denda')) {
                $table->integer('denda')
                    ->default(0)
                    ->after('status');
            }

            if (!Schema::hasColumn('peminjaman', 'kondisi')) {
                $table->string('kondisi')
                    ->nullable()
                    ->after('denda');
            }

            if (!Schema::hasColumn('peminjaman', 'catatan')) {
                $table->text('catatan')
                    ->nullable()
                    ->after('kondisi');
            }
        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {

            if (Schema::hasColumn('peminjaman', 'tanggal_dikembalikan')) {
                $table->dropColumn('tanggal_dikembalikan');
            }

            if (Schema::hasColumn('peminjaman', 'denda')) {
                $table->dropColumn('denda');
            }

            if (Schema::hasColumn('peminjaman', 'kondisi')) {
                $table->dropColumn('kondisi');
            }

            if (Schema::hasColumn('peminjaman', 'catatan')) {
                $table->dropColumn('catatan');
            }
        });
    }
};