<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.admin.profile.index', [
            'user' => Auth::user()
        ]);
    }

    public function edit()
    {
        return view('pages.admin.profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $user = Auth::user();
        $user->update($request->only('name', 'email'));

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profil berhasil diperbarui');
    }
}