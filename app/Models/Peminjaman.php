<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'nama',
        'judul',
        'tgl_pinjam',
        'tgl_kembali',
        'status'
    ];
}