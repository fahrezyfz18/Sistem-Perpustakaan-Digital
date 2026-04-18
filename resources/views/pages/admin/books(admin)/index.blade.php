<h2>Data Buku</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Judul</th>
        <th>Penulis</th>
    </tr>

    @foreach($data as $buku)
    <tr>
        <td>{{ $buku['judul'] }}</td>
        <td>{{ $buku['penulis'] }}</td>
    </tr>
    @endforeach

</table>