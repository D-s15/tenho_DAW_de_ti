<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Eloquent;
use App\Models\Book;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\Request as BookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $books = Book::all();
            
        return view('welcome', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ISBN'             => 'required|string|unique:books,ISBN',
            'title'            => 'required|string|max:255',
            'author'           => 'required|string|max:255',
            'publisher'        => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:0',
            'description'      => 'nullable|string',
            'cover_image'      => 'nullable|string', // ou file|image se for upload
        ]);

        $book = Book::create($validated);

        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with(['categories', 'wishlists', 'requests'])->findOrFail($id);
        return response()->json($book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'ISBN'             => 'required|string|unique:books,ISBN,' . $book->id,
            'title'            => 'required|string|max:255',
            'author'           => 'required|string|max:255',
            'publisher'        => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:0',
            'description'      => 'nullable|string',
            'cover_image'      => 'nullable|string',
        ]);

        $book->update($validated);

        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(['message' => 'Livro apagado com sucesso']);
    }
}
