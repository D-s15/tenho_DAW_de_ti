<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use Illuminate\Http\Request;


class BookCategoryController extends Controller
{

    public function associateBookToCategory(Request $request)
    {
        $validated = $request->validate([
            'ISBN' => 'required|string|exists:books,ISBN',
            'category_id' => 'required|integer|exists:categories,category_id'
        ]);

        // Verificar se a associação já existe
        $exists = DB::table('book_category')
            ->where('ISBN', $validated['ISBN'])
            ->where('category_id', $validated['category_id'])
            ->exists();

        if (!$exists) {
            DB::table('book_category')->insert([
                'ISBN' => $validated['ISBN'],
                'category_id' => $validated['category_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);    
        }

        return response()->json(['message' => 'Associação criada com sucesso.'], 201);
    }

    public function getBooksByCategory($categoryId)
    {
        $books = DB::table('books')
            ->join('book_category', 'books.ISBN', '=', 'book_category.ISBN')
            ->where('book_category.category_id', $categoryId)
            ->select('books.*')
            ->get();

        if ($books->isEmpty()) {
            return response()->json(['message' => 'Nenhum livro encontrado para esta categoria.'], 404);
        }

        return response()->json($books);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($ISBN, $categoryId)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($ISBN, $categoryId)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $ISBN, $categoryId)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ISBN, $categoryId)
    {
        //
    }
}
