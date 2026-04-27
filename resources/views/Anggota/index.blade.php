<form method="GET" action="{{ route('anggota.index') }}">
    <input type="text" name="search" placeholder="Cari anggota...">
    <button type="submit">Cari</button>
</form>

<h1>Data Anggota</h1>

<a href="{{ route('anggota.create') }}">Tambah Anggota</a>

@foreach($anggotas as $a)
    <p>{{ $a->nama }}</p>
@endforeach
<a href="{{ route('anggota.edit', $a->id) }}">Edit</a>

<form action="{{ route('anggota.destroy', $a->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Hapus</button>
</form>

@foreach($anggotas as $a)
    <p>{{ $a->nama }}</p>
@endforeach

{{ $anggotas->links() }}