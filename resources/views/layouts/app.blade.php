<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeafShelf</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'kombu': '#364E31',
                        'olivine': '#9AB283',
                        'asparagus': '#8FA96D',
                        'mustard': '#756633',
                        'camel': '#BC9E5F',
                        'parchment': '#F5F5DC',
                    }
                }
            }
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Alice&family=Montserrat:wght@400;600&display=swap');

        .font-alice { font-family: 'Alice', serif; }
        .font-montserrat { font-family: 'Montserrat', sans-serif; }
    </style>
</head>

<body class="bg-parchment flex items-center justify-center min-h-screen font-montserrat">

    @yield('content')

</body>
</html>