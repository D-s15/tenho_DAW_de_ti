<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="font-sans antialiased bg-light">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="/logo.png" alt="Logo" class="h-8 w-auto me-2">
                    <span class="fw-bold">Book Request</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pesquisa</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Área de Utilizador
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Wishlist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cesto de Compras</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container py-5">
            <!-- Trending Section -->
            <section class="mb-5">
                <h2 class="fw-bold mb-4">Trending</h2>
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <!-- Example Book Card -->
                    <div class="col">
                        <div class="card h-100">
                            <img src="https://covers.openlibrary.org/b/id/1-L.jpg" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="card-title">Book Title</h5>
                                <p class="card-text">Author Name</p>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat similar book cards dynamically -->
                    <div class="col">
                        <div class="card h-100">
                            <img src="https://covers.openlibrary.org/b/id/1-L.jpg" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="card-title">Book Title</h5>
                                <p class="card-text">Author Name</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100">
                            <img src="https://covers.openlibrary.org/b/id/1-L.jpg" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="card-title">Book Title</h5>
                                <p class="card-text">Author Name</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100">
                            <img src="https://covers.openlibrary.org/b/id/1-L.jpg" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="card-title">Book Title</h5>
                                <p class="card-text">Author Name</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100">
                            <img src="https://covers.openlibrary.org/b/id/1-L.jpg" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="card-title">Book Title</h5>
                                <p class="card-text">Author Name</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Popular Section -->
            <section class="mb-5">
                <h2 class="fw-bold mb-4">Populares</h2>
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <!-- Example Book Card -->
                    <div class="col">
                        <div class="card h-100">
                            <img src="https://covers.openlibrary.org/b/id/2-L.jpg" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="card-title">Book Title</h5>
                                <p class="card-text">Author Name</p>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat similar book cards dynamically -->

                    <div class="col">
                        <div class="card h-100">
                            <img src="https://covers.openlibrary.org/b/id/2-L.jpg" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="card-title">Book Title</h5>
                                <p class="card-text">Author Name</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100">
                            <img src="https://covers.openlibrary.org/b/id/2-L.jpg" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="card-title">Book Title</h5>
                                <p class="card-text">Author Name</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100">
                            <img src="https://covers.openlibrary.org/b/id/2-L.jpg" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="card-title">Book Title</h5>
                                <p class="card-text">Author Name</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100">
                            <img src="https://covers.openlibrary.org/b/id/2-L.jpg" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="card-title">Book Title</h5>
                                <p class="card-text">Author Name</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100">
                            <img src="https://covers.openlibrary.org/b/id/2-L.jpg" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="card-title">Book Title</h5>
                                <p class="card-text">Author Name</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="bg-dark text-white py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-0">&copy; 2024 Book Request. Todos os direitos reservados.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="#" class="text-white text-decoration-none me-3">Privacidade</a>
                        <a href="#" class="text-white text-decoration-none me-3">Termos</a>
                        <a href="#" class="text-white text-decoration-none">Ajuda</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
