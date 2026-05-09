<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}