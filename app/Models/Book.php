<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $fillable = [
        'judul',
        'isbn',
        'penulis',
        'penerbit',
        'kategori_id',
        'tahun',
        'stok',
        'cover',
        'deskripsi',
    ];
    /*
    |--------------------------------------------------------------------------
    | RELATION PEMINJAMAN
    |--------------------------------------------------------------------------
    */

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }
}
