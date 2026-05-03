<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background: #eee; }
    </style>
</head>
<body>

<h2>Laporan Peminjaman</h2>

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Judul</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
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
            <td>{{ $item->status }}</td>
            <td>Rp {{ number_format($item->denda,0,',','.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>