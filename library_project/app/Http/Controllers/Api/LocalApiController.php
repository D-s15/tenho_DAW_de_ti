<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
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
            $bookResponse = Http::get("https://openlibrary.org/subjects/{$category}.json");

            if ($bookResponse->failed()) {
                logger()->error("Falha ao buscar livros para a categoria: {$category}");
                continue;
            }

            $books = data_get($bookResponse->json(), 'works', []);

            $formattedBooks = collect($books)->map(function ($work) use ($category) {
                $workKey = data_get($work, 'key');
                $authorKey = data_get($work, 'authors.0.key');

                // Buscar informações da primeira edição disponível
                $editionData = $this->fetchEditionData($workKey);
                
                return [
                    'ISBN' => $editionData['isbn'],
                    'title' => data_get($work, 'title', 'Título Desconhecido'),
                    'page_number' => $editionData['pages'],
                    'author' => $this->safeApiCall("https://openlibrary.org{$authorKey}.json", 'name', 'Autor Desconhecido'),
                    'publisher' => $editionData['publisher'],
                    'cover' => data_get($work, 'cover_id') 
                        ? "https://covers.openlibrary.org/b/id/{$work['cover_id']}-M.jpg" 
                        : 'Indisponível',
                    'release_date' => $editionData['publish_date'],
                    'edition' => data_get($work, 'edition_count', 1),
                    'sinopse' => $this->safeApiCall("https://openlibrary.org{$workKey}.json", 'description', 'Sem descrição disponível'),
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

    private function fetchEditionData($workKey)
    {
        $response = Http::get("https://openlibrary.org{$workKey}/editions.json");

        if ($response->failed()) {
            return [
                'isbn' => 'Indisponível',
                'publisher' => 'Indisponível',
                'publish_date' => 'Indisponível',
                'pages' => null
            ];
        }

        $firstEdition = data_get($response->json(), 'entries.0', []);

        

        return [
            'isbn' => data_get($firstEdition, 'isbn_13.0', data_get($firstEdition, 'isbn_10.0', 'Indisponível')),
            'publisher' => data_get($firstEdition, 'publishers.0', 'Indisponível'),
            'publish_date' => data_get($firstEdition, 'publish_date', 'Indisponível'),
            'pages' => data_get($firstEdition, 'number_of_pages', null),
        ];
    }
}
