import React, { useState, useEffect } from 'react';

function BookList() {
    const [categories, setCategories] = useState([]);
    const [books, setBooks] = useState([]);
    const [selectedCategory, setSelectedCategory] = useState('');
    const [offset, setOffset] = useState(0);
    const [hasMore, setHasMore] = useState(true);

    useEffect(() => {
        fetch('/api/categories')
            .then(response => response.json())
            .then(data => setCategories(data))
            .catch(error => console.error('Erro ao obter categorias:', error));
    }, []);

    const fetchBooks = async (category, newOffset = 0) => {
        try {
            const response = await fetch(`/api/books?category_id=${category}&offset=${newOffset}`);
            const data = await response.json();
            if (newOffset === 0) {
                setBooks(data.books); // Primeira carga
            } else {
                setBooks(prevBooks => [...prevBooks, ...data.books]); // Adiciona os novos
            }
            setHasMore(data.hasMore);
        } catch (error) {
            console.error('Erro ao buscar livros:', error);
        }
    };

    const handleCategoryChange = (event) => {
        const category = event.target.value;
        setSelectedCategory(category);
        setOffset(0); // Reinicia a paginação
        if (category) {
            fetchBooks(category, 0);
        } else {
            setBooks([]);
        }
    };

    const loadMoreBooks = () => {
        const newOffset = offset + 5;
        setOffset(newOffset);
        fetchBooks(selectedCategory, newOffset);
    };

    return (
        <div className="container py-5">
            <section className="mb-5">
                <h2 className="fw-bold mb-4">Selecione uma Categoria</h2>
                <div className="dropdown mb-4">
                    <label htmlFor="category" className="form-label">Categoria:</label>
                    <select onChange={handleCategoryChange} value={selectedCategory}>
                        <option value="">Selecione uma categoria</option>
                        {categories.map((category) => (
                            <option key={category.id} value={category.category_name}>
                                {category.category_name}
                            </option>
                        ))}
                    </select>
                </div>
            </section>

            {selectedCategory && (
                <section className="mb-5">
                    <h2 className="fw-bold mb-4">Livros</h2>
                    <div className="row row-cols-1 row-cols-md-4 g-4" id="books">
                        {books.map((book) => (
                            <div className="col" key={book.ISBN}>
                                <div className="card h-100 text-center">
                                    <img
                                        src={book.cover}
                                        className="card-img-top"
                                        alt={book.title}
                                        style={{ maxWidth: '150px', height: 'auto' }}
                                    />
                                    <div className="card-body">
                                        <h5 className="card-title mt-2">{book.title}</h5>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                    {hasMore && (
                        <div className="text-center mt-4">
                            <button className="btn btn-primary" onClick={loadMoreBooks}>
                                Carregar mais
                            </button>
                        </div>
                    )}
                </section>
            )}
        </div>
    );
}

export default BookList;
