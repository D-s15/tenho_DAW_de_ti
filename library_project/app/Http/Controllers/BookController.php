<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    protected $apiController;

    public function __construct(ApiController $apiController)
    {
        $this->apiController = $apiController;
    }

    public function store(Request $request, $category)
    {
        // Fetch data from the local API endpoint
        $book_response = Http::get("http://127.0.0.1:8000/api/books/{$category}.json");
        
        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch data from the API'], 500);
        }

        $bookData = $response->json();

        // Iterate through the fetched data and store it in the local database
        foreach ($bookData['works'] as $work) {
            $isbn = $work['availability']['isbn'] ?? null;

            // Check if the book already exists in the local database
            if (Book::where('ISBN', $isbn)->exists()) {
                continue; // Skip if the book already exists
            }

            $author_response = Http::get("https://openlibrary.org/authors/{$work['author_key'][0]}.json")->json();

            $stock = 10; // Example stock value, you can modify this as needed

            $book = Book::updateOrCreate(
                ['ISBN' => $isbn],
                [
                    'title' => $work['title'],
                    'cover' => $work['cover_id'] ? "https://covers.openlibrary.org/b/id/{$work['cover_id']}-L.jpg" : null,
                    'release_date' => $work['first_publish_year'] ?? null,
                    'sinopse' => $work['description'] ?? 'No description available',
                    'available' => $stock > 0,
                    'page_number' => $work['number_of_pages'] ?? null,
                    'edition' => $work['edition_count'] ?? null,
                    'stock' => $stock,
                ]
            );
        }

        return response()->json(['message' => 'Books stored successfully!'], 201);
    }

    public function show($isbn)
    {
        $book = Book::where('ISBN', $isbn)->first();

        if (!$book) {
            return redirect()->route('home')->withErrors('Book not found!');
        }

        return view('books.show', ['book' => $book]);
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
