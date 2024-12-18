<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getApi(Request $request)
    {
        // Validar se os parâmetros necessários estão presentes
        $isbn = $request->query('isbn');
        if (!$isbn) {
            return response()->json(['error' => 'ISBN is required'], 400);
        }

        // Fazer a requisição à API da Open Library
        $response = Http::get('https://openlibrary.org/api/books', [
            'bibkeys' => "ISBN:$isbn",
            'format' => 'json',
            'jscmd' => 'data',
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch data from Open Library'], 500);
        }

        // Devolver a resposta da API
        return $response->json();
    }
}
