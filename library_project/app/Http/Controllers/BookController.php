<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Api\LocalApiController;

class BookController extends Controller
{
    public function index(Request $request, LocalApiController $localApiController)
{
    $category = $request->input('category_id');
    $offset = (int) $request->input('offset', 0); // Offset começa em 0

    if (!$category) {
        return response()->json(['message' => 'Categoria não especificada.'], 400);
    }

    // Buscar a categoria
    $categoriaExistente = Category::whereRaw('category_name = ?', [$category])->first();
    if (!$categoriaExistente) {
        return response()->json(['message' => 'Categoria não encontrada.'], 404);
    }

    $categoryId = $categoriaExistente->id;

    // Buscar livros pela categoria com limite de 5 e offset
    $books = Book::whereIn('ISBN', function ($query) use ($categoryId) {
        $query->select('ISBN')->from('book_categories')->where('category_id', $categoryId);
    })
    ->offset($offset)
    ->limit(5)
    ->get();

    // Se não houver livros suficientes, buscar na API externa
    if ($books->count() < 5 && $offset === 0) {
        return $localApiController->getBooksData($request, $category);
    }

    logger()->info("Livros encontrados: {$books}");
    
    return response()->json([
        'books' => $books,
        'hasMore' => $books->count() === 5, // Indica se há mais livros para carregar
    ]);
}


    public function store(Request $request, $category)
    {    

    }

    public function show($isbn)
    {
        return response()->json(Book::where('ISBN', $isbn)->first());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
