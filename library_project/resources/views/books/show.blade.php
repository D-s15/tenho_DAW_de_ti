@extends('layouts.app')

@section('content')
    <h1>Detalhes do Livro</h1>

    <p><strong>Título:</strong> {{ $book->title }}</p>
    <img src="{{ $book->cover }}" alt="Capa do livro" style="max-width: 200px;">
    <p><strong>Autor(es):</strong> {{ $book->author }}</p>
    <p><strong>Editora:</strong> {{ $book->publisher }}</p>
    <p><strong>Data de Lançamento:</strong> {{ $book->release_date }}</p>
    <p><strong>Sinopse:</strong> {{ $book->sinopse }}</p>
    <p><strong>Stock:</strong> {{ $book->stock }}</p>
@endsection