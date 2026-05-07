<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return view('pages.admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'batas_hari' => 'required|numeric',
            'denda_per_hari' => 'required|numeric',
        ]);

        $setting = Setting::first();

        $setting->update([
            'batas_hari' => $request->batas_hari,
            'denda_per_hari' => $request->denda_per_hari,
        ]);

        return redirect()->back()
            ->with('success', 'Pengaturan berhasil disimpan');
    }
}