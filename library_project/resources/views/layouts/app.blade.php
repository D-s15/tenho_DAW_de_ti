<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            <button class="bg-white px-3 py-1">user area</button>
            <button class="bg-white px-3 py-1">wishlist</button>
            <button class="bg-white px-3 py-1">login</button>
        </div>
    </header>

    <!-- Content Section -->
    <main class="container my-4">
        @yield('content')
    </main>

    <!-- Footnote Section -->
    <footer style="background-color: gray; color: white; text-align: center; padding: 10px; position: fixed; bottom: 0; width:100%">
        <p>AS © 2020 ESTIG / IPBeja all rights reserved</p>
    </footer>

</body>
</html>
