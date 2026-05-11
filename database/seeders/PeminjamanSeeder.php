<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peminjaman;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        Peminjaman::truncate();

        for ($i = 1; $i <= 16; $i++) {

            Peminjaman::create([

                'user_id' => $i + 1,

                'book_id' => ($i % 3) + 1,

                'tanggal_pinjam' => now()->subDays(rand(5, 15)),

                'tanggal_kembali' => now()->subDays(rand(1, 10)),

                'status' => $i <= 5
                    ? 'dipinjam'
                    : 'dikembalikan',

            ]);

        }
    }
}