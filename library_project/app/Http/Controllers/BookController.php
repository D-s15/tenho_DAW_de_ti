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
        $book_response = Http::get("http://openlibrary.org/subjects/{$category}.json");
        
        if ($book_response->failed()) {
            return response()->json(['error' => 'Failed to fetch data from the API'], 500);
        }

        $bookData = $book_response->json();

        // Iterate through the fetched data and store it in the local database
        foreach ($bookData['works'] as $work) {
            $isbn = $work['availability']['isbn'] ?? null;

            // Check if the book already exists in the local database
            if (Book::where('ISBN', $isbn)->exists()) {
                continue; // Skip if the book already exists
            }
            
            $author = Http::get("https://openlibrary.org/{$work['authors'][0]['key']}.json")->json();

            $stock = rand(0,10); // Example stock value, you can modify this as needed
            
            $work_id = Http::get("https://openlibrary.org/{$work['key']}.json")->json();

            $publisher = Http::get("https://openlibrary.org/search.json?q={$work['key']}")->json();
            
            $edition = Http::get("https://openlibrary.org/{$work['key']}/editions.json")->json(); 

            foreach ($edition['entries'] as $entry) {
                if (isset($entry['number_of_pages'])) {
                    $number_of_pages = $entry['number_of_pages'];
                    break;
                }
            }

            $book = Book::updateOrCreate(
                [
                    'ISBN' => $isbn,
                    'title' => $work['title'],
                    'page_number' => $number_of_pages,
                    'author' => $author['name'],
                    'publisher' => $edition['entries'][0]['publishers'][0] ?? 'Unavailable',
                    'cover' => $work['cover_id'] ? "https://covers.openlibrary.org/b/id/{$work['cover_id']}-M.jpg" : 'Unavailable',
                    'release_date' => $work['first_publish_year'] ?? null,
                    'edition' => $work['edition_count'] ?? null,
                    'sinopse' => $work_id['description']['value'] ?? 'No description available',
                    'available' => $stock > 0,                    
                    'stock' => $stock
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
