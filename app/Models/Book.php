<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [

        'judul',
        'isbn',
        'penulis',
        'penerbit',
        'kategori',
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
}