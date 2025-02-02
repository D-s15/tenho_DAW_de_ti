@extends('layouts.guest')

@section('content')
    <div class="container py-5">
        <!-- Dropdown List for Categories -->
        <section class="mb-5">
            <h2 class="fw-bold mb-4">Selecione uma Categoria</h2>
            <div class="dropdown mb-4">
                <select id="category" name="category_id">
                <option value="">Selecione</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                @endforeach
                </select>
            </div>
        </section>

        <!-- Books Section -->
        <section class="mb-5">
            <h2 class="fw-bold mb-4">Livros</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4" id="books">
                <!-- Example Book Card -->
                <!-- Book cards will be dynamically inserted here -->
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category');
            const booksContainer = document.getElementById('books');

            // Função para obter categorias
            function fetchCategories() {
        fetch('/api/categories')
            .then(response => response.json())
            .then(data => {
                data.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id; // ID da categoria
                    option.textContent = category.category_name; // Nome da categoria
                    categorySelect.appendChild(option); // Adiciona ao dropdown
                });
            })
            .catch(error => console.error('Erro ao obter categorias:', error));
    }

            // Função para obter livros
            function fetchBooks(categoryId) {
        fetch(`/api/books?category=${categoryId}`)
            .then(response => response.json())
            .then(data => {
                booksContainer.innerHTML = '';
                data.forEach(book => {
                    const bookDiv = document.createElement('div');
                    bookDiv.classList.add('col');
                    bookDiv.innerHTML = `
                        <div class="card h-100">
                            <img src="${book.cover}" class="card-img-top" alt="Capa do Livro">
                            <div class="card-body">
                                <h5 class="card-title">${book.title}</h5>
                                <p class="card-text">${book.author}</p>
                                <p class="card-text"><strong>ISBN:</strong> ${book.ISBN}</p>
                                <p class="card-text"><strong>Páginas:</strong> ${book.page_number}</p>
                                <p class="card-text"><strong>Editora:</strong> ${book.publisher}</p>
                                <p class="card-text"><strong>Lançamento:</strong> ${book.release_date}</p>
                                <p class="card-text"><strong>Sinopse:</strong> ${book.sinopse}</p>
                                <p class="card-text"><strong>Estoque:</strong> ${book.stock}</p>
                                <p class="card-text"><strong>Disponível:</strong> ${book.available ? 'Sim' : 'Não'}</p>
                            </div>
                        </div>
                    `;
                    booksContainer.appendChild(bookDiv);
                });
            })
            .catch(error => console.error('Erro ao obter livros:', error));
    }

            // Evento de mudança na dropdown
            categorySelect.addEventListener('change', function() {
                const categoryId = categorySelect.value;
                if (categoryId) {
                    fetchBooks(categoryId);
                } else {
                    booksContainer.innerHTML = '';
                }
            });

            // Obter categorias ao carregar a página
            fetchCategories();
        });
    </script>
@endpush