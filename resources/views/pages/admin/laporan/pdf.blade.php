<!DOCTYPE html>
<html>

<head>

    <title>Laporan PDF</title>

    <style>
        body {
            font-family: sans-serif;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            font-size: 12px;
            text-align: center;
        }

        th {
            background: #eeeeee;
        }

        .red {
            color: red;
            font-weight: bold;
        }
    </style>

</head>

<body>

    <h2>Laporan Peminjaman</h2>

    <table>

        <thead>

            <tr>
                <th>Nama</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>

        </thead>

        <tbody>

            
            @forelse($data as $item)

                    <tr>

                        <td>{{ $item->user->name ?? '-' }}</td>

                        <td>{{ $item->book->judul ?? '-' }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}
                        </td>

                        <td>
                            {{ $item->tgl_jatuh_tempo
                ? \Carbon\Carbon::parse($item->tgl_jatuh_tempo)->format('d-m-Y')
                : '-' }}
                        </td>

                        <td>
                            {{ $item->tanggal_dikembalikan
                ? \Carbon\Carbon::parse($item->tanggal_dikembalikan)->format('d-m-Y')
                : '-' }}
                        </td>

                        <td>{{ $item->status_label }}</td>

                        <td class="red">
                            Rp {{ number_format($item->denda ?? 0, 0, ',', '.') }}
                        </td>

                    </tr>

            @empty

                <tr>
                    <td colspan="7">
                        Tidak ada data pada periode yang dipilih
                    </td>
                </tr>

            @endforelse
    

        </tbody>


    </table>

</body>

</html>