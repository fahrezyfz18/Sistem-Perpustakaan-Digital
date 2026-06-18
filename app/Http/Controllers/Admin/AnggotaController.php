<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $query = Anggota::query();

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_anggota', 'like', '%' . $request->search . '%');
            });
        }

        $anggotas = $query->latest()->paginate(10);

        return view('pages.admin.anggota.index', compact('anggotas'));
    }

    public function show($id)
    {
        $anggota = Anggota::findOrFail($id);

        return view('pages.admin.anggota.detail', compact('anggota'));
    }

    public function create()
    {
        return view('pages.admin.anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'nullable|email',
            'no_hp' => 'nullable',
            'alamat' => 'nullable',
            'status' => 'required',
        ]);

        Anggota::create($request->only([
            'nama',
            'email',
            'no_hp',
            'alamat',
            'status',
        ]));

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);

        return view('pages.admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'nullable|email',
            'no_hp' => 'nullable',
            'alamat' => 'nullable',
            'status' => 'required',
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->update($request->only([
            'nama',
            'email',
            'no_hp',
            'alamat',
            'status',
        ]));

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil diupdate');
    }

    public function destroy($id)
    {
        Anggota::findOrFail($id)->delete();

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil dihapus');
    }
}