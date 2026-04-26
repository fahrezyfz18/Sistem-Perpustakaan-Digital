<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku - Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-camel { background-color: #BC9E5F; }
        .bg-mustard-dark { background-color: #756633; }
        .text-kombu { color: #364E31; }
        .border-kombu { border-color: #364E31; }
    </style>
</head>
<body class="bg-white p-8">

    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold tracking-widest uppercase inline-block border-b-4 border-kombu pb-1">
                DAFTAR BUKU
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 px-10">
            @foreach($books as $book)
            <div class="bg-white border-2 border-gray-200 rounded-xl shadow-lg overflow-hidden p-4">
                <div class="bg-gray-300 w-full h-64 rounded-lg flex items-center justify-center mb-4">
                    <span class="text-kombu font-bold text-xl text-center px-4">
                        Book Cover<br>Placeholder
                    </span>
                </div>

                <div class="space-y-1 mb-4">
                    <h3 class="text-xl font-bold leading-tight text-gray-900">
                        {{ $book['judul'] }}
                    </h3>
                    <p class="text-md italic text-gray-700">
                        Penulis: {{ $book['penulis'] }}
                    </p>
                </div>

                <button class="w-full bg-camel hover:bg-mustard-dark text-white font-bold py-3 rounded-lg transition duration-300 text-lg shadow-md active:scale-95">
                    Pinjam
                </button>
            </div>
            @endforeach
        </div>
    </div>

</body>
</html>