<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocalApiController extends Controller
{
    public function getBooksData($category)
    {
        // Fetch data from the external API
        $response = Http::get("https://openlibrary.org/subjects/{$category}.json");

        if ($response->failed()) {
            return response()->json(['error' => 'could not access API data'], 500);
        }

        $bookData = $response->json();

        // Iterate through the fetched data and store it in the local database
        foreach ($bookData['works'] as $work) {
            $stock = 10; // Default stock value
            $available = $stock > 0;

            Book::updateOrCreate(
                ['ISBN' => $work['cover_edition_key'] ?? null],
                [
                    'title' => $work['title'],
                    'page_number' => $work['number_of_pages'] ?? null,
                    'author' => implode(', ', array_map(function($author) {
                        return $author['name'];
                    }, $work['authors'] ?? [])),
                    'cover' => $work['cover_id'] ? "https://covers.openlibrary.org/b/id/{$work['cover_id']}-L.jpg" : null,
                    'release_date' => $work['first_publish_year'] ?? null,
                    'sinopse' => $work['description'] ?? 'No description available',
                    'edition' => $work['edition'] ?? null,
                    'publisher' => implode(', ', $work['publishers'] ?? []),
                    'available' => $available,
                    'stock' => $stock,
                ]
            );
        }

        return response()->json(['message' => 'Books stored successfully!'], 201);
    }
}
