<h1>Tambah Anggota</h1>

<form action="{{ route('anggota.store') }}" method="POST">
    @csrf
    <input name="nama" placeholder="Nama"><br>
    <input name="email" placeholder="Email"><br>
    <input name="no_hp" placeholder="No HP"><br>
    <textarea name="alamat"></textarea><br>

    <button type="submit">Simpan</button>
</form>