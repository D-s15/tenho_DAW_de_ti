<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />
        <!-- Navbar -->
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <a href="#" class="flex items-center">
                            <img src="/logo.png" alt="Logo" class="h-8 w-auto">
                            <span class="ml-2 font-semibold text-gray-800">Book Request</span>
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="#" class="text-gray-500 hover:text-gray-700">Pesquisa</a>
                        <a href="#" class="text-gray-500 hover:text-gray-700">Área de Utilizador</a>
                        <a href="#" class="text-gray-500 hover:text-gray-700">Wishlist</a>
                        <a href="#" class="text-gray-500 hover:text-gray-700">Cesto de Compras</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        
        <!-- Footer -->
        <footer class="bg-gray-800 text-white">
            <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
                <div class="flex justify-between">
                    <div>
                        <h5 class="text-lg font-semibold">Sobre Nós</h5>
                        <p class="text-sm mt-2">Informações sobre o sistema de requisição de livros.</p>
                    </div>
                    <div>
                        <h5 class="text-lg font-semibold">Links Úteis</h5>
                        <ul class="mt-2 space-y-1 text-sm">
                            <li><a href="#" class="hover:underline">Política de Privacidade</a></li>
                            <li><a href="#" class="hover:underline">Termos de Serviço</a></li>
                            <li><a href="#" class="hover:underline">Ajuda</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="text-lg font-semibold">Segue-nos</h5>
                        <div class="flex space-x-4 mt-2">
                            <a href="#" class="hover:text-gray-400">Facebook</a>
                            <a href="#" class="hover:text-gray-400">Twitter</a>
                            <a href="#" class="hover:text-gray-400">Instagram</a>
                        </div>
                    </div>
                </div>
                <div class="text-center text-sm mt-4">&copy; 2024 Book Request Project. Todos os direitos reservados.</div>
            </div>
        </footer>

        @stack('modals')

        @livewireScripts
    </body>
</html>
