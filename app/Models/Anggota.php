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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($anggota) {

            do {
                $kode = 'AGT-' . date('Ymd') . rand(100, 999);
            } while (self::where('kode_anggota', $kode)->exists());

            $anggota->kode_anggota = $kode;
        });
    }
}