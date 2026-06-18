<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = Peminjaman::with('book')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view(
            'pages.user.history.index',
            compact('histories')
        );
    }
}