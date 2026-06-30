<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengembalian extends Model
{
    /**
     * Nama tabel.
     */
    protected $table = 'pengembalian';

    /**
     * Primary key.
     */
    protected $primaryKey = 'id_pengembalian';

    /**
     * Mass assignment.
     */
    protected $fillable = [
        'id_peminjaman',
        'tgl_kembali',
        'terlambat_hari',
    ];

    /**
     * Casting.
     */
    protected $casts = [
        'tgl_kembali' => 'date',
        'terlambat_hari' => 'integer',
    ];

    /**
     * Relasi ke peminjaman.
     */
    public function peminjaman(): BelongsTo
    {
        return $this->belongsTo(
            Peminjaman::class,
            'id_peminjaman',
            'id'
        );
    }
}