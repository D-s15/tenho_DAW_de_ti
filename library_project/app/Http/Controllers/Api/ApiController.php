<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getBookData($isbn)
    {
        // Fazer a requisição à API com o ISBN
        $response = Http::get('https://openlibrary.org/api/books', [
            'bibkeys' => "ISBN:$isbn",
            'format' => 'json',
            'jscmd' => 'data',
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Erro ao buscar dados da API'], 500);
        }

        // Retornar os dados em JSON
        return response()->json($response->json());
    }
}
