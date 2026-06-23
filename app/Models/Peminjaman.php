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
        'tgl_jatuh_tempo',
        'tanggal_dikembalikan',
        'status',
        'denda',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tgl_jatuh_tempo' => 'date',
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

    public function getStatusLabelAttribute()
    {
        if ($this->status === 'dikembalikan') {
            return 'Dikembalikan';
        }

        if (
            $this->status === 'dipinjam' &&
            $this->tgl_jatuh_tempo &&
            now()->startOfDay()->gt($this->tgl_jatuh_tempo->startOfDay())
        ) {
            return 'Terlambat';
        }

        return 'Dipinjam';
    }
 public function getDendaTerlambatAttribute()
{
    // Jika tidak ada tanggal jatuh tempo, tidak ada denda
    if (!$this->tgl_jatuh_tempo) return 0;

    // KONDISI 1: Buku belum dikembalikan dan sudah lewat jatuh tempo
    if ($this->status === 'dipinjam') {
        if (now()->gt($this->tgl_jatuh_tempo)) {
            $hariTerlambat = ceil($this->tgl_jatuh_tempo->diffInDays(now(), false));
            return ($hariTerlambat < 1 ? 1 : $hariTerlambat) * 2000;
        }

        return 0;
    }
}