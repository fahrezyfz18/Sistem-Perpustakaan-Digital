<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggotas';

    protected $fillable = [
        'kode_anggota',
        'nama',
        'email',
        'no_hp',
        'alamat',
        'status',
    ];

    /**
     * Auto generate kode anggota
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($anggota) {
            $anggota->kode_anggota = 'AGT-' . date('Ymd') . rand(100,999);
        });
    }
}