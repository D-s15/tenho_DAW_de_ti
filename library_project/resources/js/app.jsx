//import './bootstrap';
import React from 'react';
import ReactDOM from 'react-dom/client';
import BookList from './components/BookList';

const rootElement = document.getElementById('book-list');
if (rootElement) {
    const root = ReactDOM.createRoot(rootElement);
    root.render(<BookList />);
}