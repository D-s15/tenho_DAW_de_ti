<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-200">
    <!-- Cabeçalho -->
    <header class="bg-gray-700 flex justify-between items-center p-3">
        <div class="text-white text-lg">Logotipo</div>

        <div class="flex items-center gap-2">
            <!-- Barra de pesquisa -->
            <div class="flex border border-gray-400 rounded">
                <input type="text" placeholder="Pesquisar..." class="px-2 py-1 outline-none">
                <button class="px-2">🔍</button>
            </div>
            
            <!-- Botões -->
            <a class="bg-white px-3 py-1">user area</a>
            <a class="bg-white px-3 py-1">wishlist</a>
            <a class="bg-white px-3 py-1" href="{{route('users.login')}}" >login</a>
        </div>
    </header>

    <!-- Content Section -->
    <main class="my-4" style="width:100%; padding-top:90px; padding-bottom:60px;">
            
    @yield('content')
    </main>

    <!-- Footnote Section -->
    <footer style="background-color: gray; color: white; text-align: center; padding: 10px; position: fixed; bottom: 0; width:100%">
        <p>AS © 2020 ESTIG / IPBeja all rights reserved</p>
    </footer>
</body>
</html>
