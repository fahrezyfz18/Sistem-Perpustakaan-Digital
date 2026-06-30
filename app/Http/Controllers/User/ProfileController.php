<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Ubah method dari index() menjadi show()
    public function show()
    {
        return view('pages.user.profile.index', [
            'user' => Auth::user()
        ]);
    }

    public function edit()
    {
        return view('pages.user.profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Mengambil data teks
        $data = $request->only(['name', 'email', 'username', 'no_hp', 'alamat']);

        // Logika Upload Foto
        if ($request->hasFile('avatar')) {
            // Hapus file lama jika ada (opsional)
            if ($user->avatar && file_exists(public_path('avatars/' . $user->avatar))) {
                unlink(public_path('avatars/' . $user->avatar));
            }

            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('avatars'), $filename);
            $data['avatar'] = $filename;
        }

        $user->update($data);

        return redirect()
            ->route('user.profile.show')
            ->with('success', 'Profil berhasil diperbarui');
    }
    public function destroy()
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();
        return redirect('/');
    }
}