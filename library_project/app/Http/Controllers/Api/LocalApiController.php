<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class LocalApiController extends Controller
{
    public function getBooksData(Request $request, $category)
    {
        $limit = $request->query('limit', 5); // Número de itens por página
        $offset = $request->query('offset', 0); // Offset inicial, padrão é 0

        $subjectUrl = "https://openlibrary.org/subjects/{$category}.json?limit={$limit}&offset={$offset}";

        $response = Http::get($subjectUrl);
        
        if ($response->failed()) {
            logger()->error("Falha ao buscar dados de {$subjectUrl}");
            return response()->json(['message' => 'Falha ao extrair dados de {$subjectUrl}'], 500);
        }

        $bookResponse = $response->json();
        $books = data_get($bookResponse, 'works', []);

        // Processar os dados dos livros
        $formattedBooks = collect($books)->map(function ($work) {
            $workKey = data_get($work, 'key');
            $authorKey = data_get($work, 'authors.0.key');

            // Buscar informações da primeira edição disponível
            $editionData = $this->fetchEditionData($workKey);

            // Extrair apenas o ano do publish_date
            $releaseYear = (function($date) {
                if ($date) {
                    if (preg_match('/\d{4}/', $date, $matches)) {
                        return $matches[0];
                    }
                }
                return null;
            })(data_get($editionData, 'publish_date'));

            $storageCategories = DB::table('categories')->pluck('category_name')->toArray();
            $subjects = data_get($work, 'subject', []);
            $localSubjects = array_filter($storageCategories, function ($subject) use ($work) {
                return in_array($subject, data_get($work, 'subject', []));
            });

            // Reindexar o array para garantir que apenas as strings sejam retornadas
            $localSubjects = array_values($localSubjects);
            
            $stock = rand(0, 10);
            return [
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
                'categories' => $localSubjects,
                'stock' => $stock,
                'available' => $stock > 0 ? 1 : 0
            ];
        });

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
        $selectedEdition = [];
        $selectedPublisher = [];
        $selectedPublishDate = [];
        $pages = [];
        $isbn = [];


        // Itera sobre as entradas e seleciona a primeira que contenha a chave "publishers"
        foreach ($editions as $edition) {
            if (isset($edition['revision']) && !empty($edition['revision']) && empty($selectedEdition))
                $selectedEdition = $edition;
            
            if (isset($edition['publishers']) && !empty($edition['publishers']) && empty($selectedPublisher))
                $selectedPublisher = $edition;
            if (isset($edition['publish_date']) && !empty($edition['publish_date']) && empty($selectedPublishDate))
                $selectedPublishDate = $edition;
            if (isset($edition['number_of_pages']) && !empty($edition['number_of_pages']) && empty($pages))
                $pages = $edition;
            if ((isset($edition['isbn_13'])) && !empty($edition['isbn_13']) || (isset($edition['isbn_10']) && !empty($edition['isbn_10'])) && empty($isbn))
                $isbn = $edition;
            if (!empty($selectedEdition) && !empty($selectedPublisher) && !empty($selectedPublishDate) && !empty($pages) && !empty($isbn))
                break;
        }


        // Se nenhuma edição com "publishers" foi encontrada, pode-se optar por utilizar a primeira entrada
        // if (empty($selectedEdition)) {
        //     $selectedEdition = data_get($response->json(), 'entries.0', []);
        // }

        return [
            'isbn' => data_get($isbn, 'isbn_13.0', data_get($isbn, 'isbn_10.0', 'Indisponível')),
            'publisher' => data_get($selectedPublisher, 'publishers.0', 'Indisponível'),
            'publish_date' => data_get($selectedPublishDate, 'publish_date', 'Indisponível'),
            'pages' => data_get($pages, 'number_of_pages', null),
        ];
    }
}
