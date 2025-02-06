<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Category;

class LocalApiController extends Controller
{
    private $book;
    public function getBooksData(Request $request, $category)
    {
        $limit = $request->query('limit', 5);
        $offset = $request->query('offset', 0);

        $subjectUrl = "https://openlibrary.org/subjects/{$category}.json?limit={$limit}&offset={$offset}";
        
        logger()->info("url: ", [$subjectUrl]);
        $response = Http::get($subjectUrl);
        
        if ($response->failed()) {
            return response()->json(['message' => "Falha ao extrair dados de {$subjectUrl}"], 500);
        }

        $bookResponse = $response->json();
        $books = data_get($bookResponse, 'works', []);

        $formattedBooks = collect($books)->map(function ($work) use ($category) {
            $workKey = data_get($work, 'key');
            $editionData = $this->fetchEditionData($workKey);
            
            $bookExists = Book::where('ISBN', $editionData['isbn'])->exists();
        
            if(!$bookExists) {
                $authorKey = data_get($work, 'authors.0.key');

                $releaseYear = (function($date) {
                    if ($date && preg_match('/\d{4}/', $date, $matches)) {
                        return $matches[0];
                    }
                    return null;

                })(data_get($editionData, 'publish_date'));
                
                logger()->info("release year: ", [$releaseYear]);
                $data =['ISBN' => $editionData['isbn'],
                            'title' => data_get($work, 'title', 'Título Desconhecido'),
                            'page_number' => $editionData['pages'],
                            'author' => $this->safeApiCall("https://openlibrary.org{$authorKey}.json", 'name', 'Autor Desconhecido'),
                            'publisher' => $editionData['publisher'],
                            'cover' => data_get($work, 'cover_id') 
                                ? "https://covers.openlibrary.org/b/id/{$work['cover_id']}-M.jpg" 
                                : 'Indisponível',
                            'release_date' => $releaseYear,
                            'edition' => data_get($work, 'edition_count', 1),
                            'sinopse' => $this->safeApiCall("https://openlibrary.org{$workKey}.json", 'description.0', 'Sem descrição disponível'),
                            'stock' => rand(0, 10),
                            'available' => rand(0, 10) > 0 ? 1 : 0
                ];
                logger()->info("data: ", $data);

                $this->book = Book::updateOrCreate(['ISBN' => $editionData['isbn']],$data);
                
                logger()->info("this book: ", [$this->book]);
                $existingCategories = Category::whereIn('category_name', $work['subject'])->pluck('category_id');
                
                logger()->info("categories: ", [$existingCategories]);
                    foreach ($existingCategories as $categoryId) {
                    $associate = BookCategory::updateOrCreate(
                    ['ISBN' => $this->book->ISBN, 'category_id' => $categoryId]
                    );
                    logger()->info("dados do livro: ", $associate);    
                }
                    
                }
                
                logger()->info("livro: ", $this->book);

                return $this->book;
            
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
            'pages' => null,
        ];
    }

    $editions = data_get($response->json(), 'entries', []);

    // Verificando o ISBN de forma mais robusta
    $isbn = collect($editions)->firstWhere(function ($entry) {
        return !empty($entry['isbn_13']) || !empty($entry['isbn_10']);
    }) ?? ['isbn_13' => 'Indisponível', 'isbn_10' => 'Indisponível'];

    // Verificando o publisher de forma mais segura
    $publisher = collect($editions)->firstWhere('publishers', function ($value) {
        return !empty($value);
    })['publishers'][0] ?? 'Indisponível';

    // Verificando a data de publicação de forma mais robusta
    $publishDate = collect($editions)->firstWhere('publish_date', function ($value) {
        return !empty($value);
    })['publish_date'] ?? 'Indisponível';

    return [
        'isbn' => data_get($isbn, 'isbn_13.0', data_get($isbn, 'isbn_10.0', 'Indisponível')),
        'publisher' => $publisher,
        'publish_date' => $publishDate,
        'pages' => data_get($editions, '0.number_of_pages', null),
    ];
    }
}
