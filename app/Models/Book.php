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
        'category_id',
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
