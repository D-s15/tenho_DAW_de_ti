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
        $category = strtolower($request->input('category_id'));
        //$categoriaExistente = Categoria::whereRaw('LOWER(nome) = ?', [$categoria])->first();
        $categoriaExistente = Category::whereRaw('LOWER(category_name) = ?', [$category])->first();
        if (!$category) {
            return response()->json(['message' => 'Categoria não especificada.'], 400);
        }
        return $localApiController->getBooksData($request, $category);
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
