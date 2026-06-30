<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Menampilkan halaman pengaturan.
     */
    public function index()
    {
        // Mengambil record pertama atau membuat objek baru jika belum ada
        $setting = Setting::first() ?? new Setting();

        return view('pages.admin.settings.index', compact('setting'));
    }

    /**
     * Memperbarui pengaturan sistem.
     * Menggunakan PUT/PATCH sesuai dengan rute yang diperbarui di web.php
     */
    public function update(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'batas_hari'     => 'required|integer|min:1',
            'denda_per_hari' => 'required|numeric|min:0',
        ]);

        // 2. Mengambil record atau membuat record baru jika tabel kosong
        $setting = Setting::firstOrCreate([]);

        // 3. Update data
        $setting->update([
            'batas_hari'     => $request->batas_hari,
            'denda_per_hari' => $request->denda_per_hari,
        ]);

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan sistem berhasil diperbarui.');
    }
}