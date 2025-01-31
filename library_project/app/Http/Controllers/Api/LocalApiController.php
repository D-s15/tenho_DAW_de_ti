<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocalApiController extends Controller
{
    public function getBooksData()
{
    $categories = [
        "fiction", //"Mystery", "Suspense",  
        //"Romance", "Horror", "Adventure", "Comedy", "Cooking", 
        //"Fantasy", "Action", "Kids", "Thriller",
    ];

    $allBooks = [];

    foreach ($categories as $category) {
        $bookResponse = Http::get("http://openlibrary.org/subjects/{$category}.json");

        if ($bookResponse->failed()) {
            logger()->error("Falha ao buscar livros para a categoria: {$category}");
            continue;
        }

        $books = data_get($bookResponse->json(), 'works', []);
        
        
        $formattedBooks = collect($books)->map(function ($work) use ($category) {
            $workKey = data_get($work, 'key');
            $authorKey = data_get($work, 'authors.0.key');

            return [
                'ISBN' => data_get($work, 'availability.isbn', 'Indisponível'),
                'title' => data_get($work, 'title', 'Título Desconhecido'),
                'page_number' => $this->fetchNumberOfPages($workKey),
                'author' => $this->safeApiCall("https://openlibrary.org/{$authorKey}.json", 'name', 'Autor Desconhecido'),
                'publisher' => $this->fetchPublisher($workKey),
                'cover' => data_get($work, 'cover_id') 
                    ? "https://covers.openlibrary.org/b/id/{$work['cover_id']}-M.jpg" 
                    : 'Indisponível',
                'release_date' => data_get($work, 'first_publish_year'),
                'edition' => data_get($work, 'edition_count', 1),
                'sinopse' => $this->safeApiCall("https://openlibrary.org/{$workKey}.json", 'description.value', 'Sem descrição disponível'),
                'categories' => [$category],
            ];
        });

        $allBooks = array_merge($allBooks, $formattedBooks->toArray());
    }

        return response()->json($allBooks);
    }

    private function safeApiCall($url, $keyPath, $default = null)
    {
        $response = Http::get($url);

        if ($response->failed()) {
            logger()->error("Falha ao buscar dados de {$url}");
            return $default;
        }

        return data_get($response->json(), $keyPath, $default);
    }

    private function fetchPublisher($workKey)
    {
        $response = Http::get("https://openlibrary.org/search.json?q={$workKey}");

        return $response->successful() ? data_get($response->json(), 'docs.0.publisher.0', 'Indisponível') : 'Indisponível';
    }

    private function fetchNumberOfPages($workKey)
    {
        $response = Http::get("https://openlibrary.org/{$workKey}/editions.json");

        return collect(data_get($response->json(), 'entries', []))
            ->pluck('number_of_pages')
            ->filter()
            ->first();
    }
}