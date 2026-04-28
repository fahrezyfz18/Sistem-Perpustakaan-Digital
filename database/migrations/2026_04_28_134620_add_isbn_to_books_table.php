<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom isbn ke tabel books
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('isbn')->nullable();
        });
    }

    /**
     * Hapus kolom isbn (rollback)
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('isbn');
        });
    }
};