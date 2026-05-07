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
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Denda</th>

            </tr>

        </thead>

        <tbody>

            @foreach($data as $item)

                <tr>

                    <td>{{ $item->nama }}</td>

                    <td>{{ $item->judul }}</td>

                    <td>{{ $item->tgl_pinjam }}</td>

                    <td>{{ $item->tgl_kembali }}</td>

                    <td>{{ ucfirst($item->status) }}</td>

                    <td class="red">

                        Rp {{ number_format($item->denda ?? 0, 0, ',', '.') }}

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</body>

</html>