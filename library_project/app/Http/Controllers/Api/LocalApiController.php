<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\BookCategory;

class LocalApiController extends Controller
{
    public function getBooksData(Request $request, $category)
    {
        $limit = $request->query('limit', 5);
        $offset = $request->query('offset', 0);

        $subjectUrl = "https://openlibrary.org/subjects/{$category}.json?limit={$limit}&offset={$offset}";
        
        logger()->info("URL chamada: {$subjectUrl}");

        $response = Http::get($subjectUrl);

        if ($response->failed()) {
            logger()->error("Falha ao buscar dados de {$subjectUrl}");
            return response()->json(['message' => "Falha ao extrair dados de {$subjectUrl}"], 500);
        }

        $bookResponse = $response->json();
        $books = data_get($bookResponse, 'works', []);

        $formattedBooks = collect($books)->map(function ($work) use ($category) {
            $workKey = data_get($work, 'key');
            $authorKey = data_get($work, 'authors.0.key');

            $editionData = $this->fetchEditionData($workKey);

            $releaseYear = (function($date) {
                if ($date && preg_match('/\d{4}/', $date, $matches)) {
                    return $matches[0];
                }
                return null;
            })(data_get($editionData, 'publish_date'));

            $bookData = [
                'ISBN' => $editionData['isbn'],
                'title' => data_get($work, 'title', 'Título Desconhecido'),
                'page_number' => $editionData['pages'],
                'author' => $this->safeApiCall("https://openlibrary.org{$authorKey}.json", 'name', 'Autor Desconhecido'),
                'publisher' => $editionData['publisher'],
                'cover' => data_get($work, 'cover_id') 
                    ? "https://covers.openlibrary.org/b/id/{$work['cover_id']}-M.jpg" 
                    : 'Indisponível',
                'release_date' => $releaseYear,
                'edition' => data_get($work, 'edition_count', 1),
                'sinopse' => $this->safeApiCall("https://openlibrary.org{$workKey}.json", 'description', 'Sem descrição disponível'),
                'stock' => rand(0, 10),
                'available' => rand(0, 10) > 0 ? 1 : 0
            ];

            $book = Book::updateOrCreate(
                ['ISBN' => $bookData['ISBN']],
                $bookData
            );

            $categoryId = DB::table('categories')->where('category_name', $category)->value('category_id');

            if ($categoryId) {
                BookCategory::updateOrCreate([
                    'ISBN' => $book->ISBN,
                    'category_id' => $categoryId
                ]);
            }

            return $bookData;
        });

        logger()->info('Livros formatados:', $formattedBooks->toArray());

        return response()->json($formattedBooks->toArray());
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
        $promise = Http::async()->get("https://openlibrary.org{$workKey}/editions.json");
        $response = $promise->wait();

        if ($response->failed()) {
            return [
                'isbn' => 'Indisponível',
                'publisher' => 'Indisponível',
                'publish_date' => 'Indisponível',
                'pages' => null
            ];
        }

        $editions = data_get($response->json(), 'entries', []);
        $isbn = collect($editions)->firstWhere('isbn_13') ?? collect($editions)->firstWhere('isbn_10');

        return [
            'isbn' => data_get($isbn, 'isbn_13.0', data_get($isbn, 'isbn_10.0', 'Indisponível')),
            'publisher' => data_get($editions, '0.publishers.0', 'Indisponível'),
            'publish_date' => data_get($editions, '0.publish_date', 'Indisponível'),
            'pages' => data_get($editions, '0.number_of_pages', null),
        ];
    }
}
