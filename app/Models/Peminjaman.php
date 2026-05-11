<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use App\Models\Setting;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    protected $appends = [
        'denda',
        'hari_telat'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION : USER
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION : BOOK
    |--------------------------------------------------------------------------
    */

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /*
    |--------------------------------------------------------------------------
    | HARI TELAT
    |--------------------------------------------------------------------------
    */

    public function getHariTelatAttribute()
    {
        if (!$this->tanggal_kembali) {
            return 0;
        }

        if ($this->status == 'dikembalikan') {
            return 0;
        }

        $today = Carbon::now()->startOfDay();

        $tanggalKembali = Carbon::parse(
            $this->tanggal_kembali
        )->startOfDay();

        if ($today->gt($tanggalKembali)) {

            return $tanggalKembali
                ->diffInDays($today);
        }

        return 0;
    }

    /*
    |--------------------------------------------------------------------------
    | DENDA
    |--------------------------------------------------------------------------
    */

    public function getDendaAttribute()
    {
        $setting = Setting::first();

        $dendaPerHari = $setting->denda_per_hari ?? 2000;

        return $this->hari_telat * $dendaPerHari;
    }
}