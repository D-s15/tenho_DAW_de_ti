<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    public function index(Request $request, LocalApiController $localApiController)
    {
        $category = $request->query('category', 'action'); // Categoria padrão é 'action'
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
