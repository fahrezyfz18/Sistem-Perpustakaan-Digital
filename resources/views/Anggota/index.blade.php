<h1>Data Anggota</h1>

<a href="{{ route('anggota.create') }}">Tambah Anggota</a>

@foreach($anggotas as $a)
    <p>{{ $a->nama }}</p>
@endforeach