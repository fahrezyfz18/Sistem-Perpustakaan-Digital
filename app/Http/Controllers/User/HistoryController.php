<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = Peminjaman::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.history.index', compact('histories'));
    }
}