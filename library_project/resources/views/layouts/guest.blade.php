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

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="font-sans antialiased bg-light">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="/logo.png" alt="Logo" class="h-8 w-auto me-2">
                    <span class="fw-bold">{{ config('app.name', 'Book Request') }}</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ __('Pesquisa') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ __('Cesto de Compras') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('Área de Utilizador') }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="align-items-center">
            @yield('content')
        </div>


        @livewireScripts

        <!-- Footer -->
        <footer class="bg-dark text-white py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-0">&copy; {{ now()->year }} {{ config('app.name', 'Book Request') }}. {{ __('Todos os direitos reservados.') }}</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="#" class="text-white text-decoration-none me-3">{{ __('Privacidade') }}</a>
                        <a href="#" class="text-white text-decoration-none me-3">{{ __('Termos') }}</a>
                        <a href="#" class="text-white text-decoration-none">{{ __('Ajuda') }}</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
