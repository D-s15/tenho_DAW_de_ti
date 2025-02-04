import React, { useState, useEffect } from 'react';

function BookList() {
    const [categories, setCategories] = useState([]);
    const [books, setBooks] = useState([]);
    const [selectedCategory, setSelectedCategory] = useState('');

    useEffect(() => {
        fetch('/api/categories')
            .then(response => response.json())
            .then(data => setCategories(data))
            .catch(error => console.error('Erro ao obter categorias:', error));
    }, []);

    useEffect(() => {
        if (selectedCategory) {
            fetch(`/api/books?category=${selectedCategory}`)
                .then(response => response.json())
                .then(data => setBooks(data))
                .catch(error => console.error('Erro ao obter livros:', error));
        } else {
            setBooks([]);
        }
    }, [selectedCategory]);

    return (
        <div className="container py-5">
            <section className="mb-5">
                <h2 className="fw-bold mb-4">Selecione uma Categoria</h2>
                <div className="dropdown mb-4">
                    <label htmlFor="category" className="form-label">Categoria:</label>
                    <select
                        id="category"
                        className="form-select"
                        value={selectedCategory}
                        onChange={(e) => setSelectedCategory(e.target.value)}
                    >
                        <option value="">Selecione</option>
                        {categories.map((category) => (
                            <option key={category.id} value={category.id}>
                                {category.category_name}
                            </option>
                        ))}
                    </select>
                </div>
            </section>

            <section className="mb-5">
                <h2 className="fw-bold mb-4">Livros</h2>
                <div className="row row-cols-1 row-cols-md-4 g-4" id="books">
                    {books.map((book) => (
                        <div className="col" key={book.ISBN}>
                            <div className="card h-100">
                                <img src={book.cover} className="card-img-top" alt="Book Cover" />
                                <div className="card-body">
                                    <h5 className="card-title">{book.title}</h5>
                                    <p className="card-text">{book.author}</p>
                                    <p className="card-text"><strong>ISBN:</strong> {book.ISBN}</p>
                                    <p className="card-text"><strong>Páginas:</strong> {book.page_number}</p>
                                    <p className="card-text"><strong>Editora:</strong> {book.publisher}</p>
                                    <p className="card-text"><strong>Data de Lançamento:</strong> {book.release_date}</p>
                                    <p className="card-text"><strong>Sinopse:</strong> {book.sinopse}</p>
                                    <p className="card-text"><strong>Estoque:</strong> {book.stock}</p>
                                    <p className="card-text"><strong>Disponível:</strong> {book.available ? 'Sim' : 'Não'}</p>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </section>
        </div>
    );
}

export default BookList;