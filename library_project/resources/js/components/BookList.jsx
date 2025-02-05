import React, { useState, useEffect } from 'react';

function BookList() {
    const [categories, setCategories] = useState([]);
    const [books, setBooks] = useState([]);
    const [selectedCategory, setSelectedCategory] = useState('');

    // Carregar categorias quando o componente for montado
    useEffect(() => {
        fetch('/api/categories')
            .then(response => response.json())
            .then(data => setCategories(data))
            .catch(error => console.error('Erro ao obter categorias:', error));
    }, []);

    // Carregar livros sempre que a categoria for alterada
    useEffect(() => {
        if (selectedCategory) {
            fetch(`/api/books?category=${selectedCategory}`)
                .then(response => response.json())
                .then(data => setBooks(data))
                .catch(error => console.error('Erro ao obter livros:', error));
        } else {
            setBooks([]); // Limpar livros se não houver categoria selecionada
        }
    }, [selectedCategory]);

    const fetchBooks = async (category) => {
        try {
          const response = await fetch(`/api/books?category_id=${category}`);
          const data = await response.json();
          setBooks(data);
        } catch (error) {
          console.error('Erro ao buscar livros:', error);
        }
    };

    const handleCategoryChange = (selectedCategory) => {
        if (selectedCategory) {
          fetchBooks(selectedCategory);
        }
    };
    
    return (
        <div className="container py-5">
            <section className="mb-5">
                <h2 className="fw-bold mb-4">Selecione uma Categoria</h2>
                <div className="dropdown mb-4">
                    <label htmlFor="category" className="form-label">Categoria:</label>
                    <select onChange={(e) => handleCategoryChange(e.target.value)}>
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
                                    <img src={book.cover} className="card-img-top" alt={book.title} style={{ height: '300px', objectFit: 'cover' }} />
                                    <div className="card-body">
                                        <h5 className="card-title mt-2">{book.title}</h5>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </section>
            )}
        </div>
    );
}

export default BookList;
