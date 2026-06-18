<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pinjam',
        'deadline',
        'tanggal_dikembalikan',
        'status',
        'denda'
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'deadline' => 'date',
        'tanggal_dikembalikan' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public static function isAlreadyBorrowed($userId, $bookId)
    {
        return self::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->where('status', 'dipinjam')
            ->exists();
    }
}