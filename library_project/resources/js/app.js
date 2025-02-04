import './bootstrap';
import React from 'react';
import ReactDOM from 'react-dom/client';
import BookList from './components/BookList';

if (document.getElementById('book-list')) {
    const root = ReactDOM.createRoot(document.getElementById('book-list'));
    root.render(<BookList />);
}