<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (
            Schema::hasColumn('books', 'category_id') &&
            !Schema::hasColumn('books', 'kategori_id')
        ) {
            Schema::table('books', function (Blueprint $table) {
                $table->renameColumn('category_id', 'kategori_id');
            });
        }
    }

    public function down(): void
    {
        if (
            Schema::hasColumn('books', 'kategori_id') &&
            !Schema::hasColumn('books', 'category_id')
        ) {
            Schema::table('books', function (Blueprint $table) {
                $table->renameColumn('kategori_id', 'category_id');
            });
        }
    }
};