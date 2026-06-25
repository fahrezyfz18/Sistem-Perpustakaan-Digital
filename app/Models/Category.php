<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'nama'
    ];

    /**
     * Get all books for the category.
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'kategori_id');
    }
}