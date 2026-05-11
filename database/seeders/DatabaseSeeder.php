<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        User::updateOrCreate(
            [
                'email' => 'admin@gmail.com'
            ],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | USER ANGELA
        |--------------------------------------------------------------------------
        */

        User::updateOrCreate(
            [
                'email' => 'angelaangeli799@gmail.com'
            ],
            [
                'name' => 'Angela',
                'password' => Hash::make('123456789'),
                'role' => 'user',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | USER 1 - 16
        |--------------------------------------------------------------------------
        */

        for ($i = 1; $i <= 16; $i++) {

            User::updateOrCreate(
                [
                    'email' => 'user' . $i . '@gmail.com'
                ],
                [
                    'name' => 'User ' . $i,
                    'password' => Hash::make('password'),
                    'role' => 'user',
                ]
            );

        }

        /*
        |--------------------------------------------------------------------------
        | BUKU
        |--------------------------------------------------------------------------
        */

        $bookList = [

            'Laravel Dasar',
            'Bumi',
            'PHP Modern',
            'Laskar Pelangi',
            'Atomic Habits',
            'Clean Code',
            'Flutter',
            'Pemrograman Web'

        ];

        foreach ($bookList as $judul) {

            Book::updateOrCreate(
                [
                    'judul' => $judul
                ],
                [
                    'isbn' => rand(1000, 9999),
                    'penulis' => 'Tere Liye',
                    'penerbit' => 'Gramedia',
                    'kategori' => 'Novel',
                    'tahun' => 2026,
                    'stok' => 10,
                ]
            );

        }

        /*
        |--------------------------------------------------------------------------
        | HAPUS DATA PEMINJAMAN LAMA
        |--------------------------------------------------------------------------
        */

        Peminjaman::truncate();

        /*
        |--------------------------------------------------------------------------
        | DATA PEMINJAMAN
        |--------------------------------------------------------------------------
        */

        $users = User::where('role', 'user')
            ->orderBy('id')
            ->get();

        $books = Book::all();

        foreach ($users as $index => $user) {

            /*
            |--------------------------------------------------------------------------
            | VARIASI TANGGAL PINJAM
            |--------------------------------------------------------------------------
            */

            $tanggalPinjam = match ($index % 4) {

                0 => Carbon::parse('2026-05-01'),
                1 => Carbon::parse('2026-05-02'),
                2 => Carbon::parse('2026-05-03'),
                default => Carbon::parse('2026-05-04'),

            };

            /*
            |--------------------------------------------------------------------------
            | 5 USER TERLAMBAT
            |--------------------------------------------------------------------------
            */

            if ($index < 5) {

                $jatuhTempo = match ($index) {

                    0 => Carbon::parse('2026-05-07'),
                    1 => Carbon::parse('2026-05-09'),
                    2 => Carbon::parse('2026-05-10'),
                    3 => Carbon::parse('2026-05-07'),
                    default => Carbon::parse('2026-05-09'),

                };

                $status = 'dipinjam';

            } else {

                /*
                |--------------------------------------------------------------------------
                | USER NORMAL
                |--------------------------------------------------------------------------
                */

                $jatuhTempo = match ($index % 3) {

                    0 => Carbon::parse('2026-05-20'),
                    1 => Carbon::parse('2026-05-22'),
                    default => Carbon::parse('2026-05-25'),

                };

                $status = $index % 2 == 0
                    ? 'dipinjam'
                    : 'dikembalikan';

            }

            Peminjaman::create([

                'user_id' => $user->id,

                'book_id' => $books[$index % $books->count()]->id,

                'tanggal_pinjam' => $tanggalPinjam,

                'tanggal_kembali' => $jatuhTempo,

                'status' => $status,

            ]);

        }
    }
}