<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getBookData($category)
    {
        // Fazer a requisição à API com a categoria
        $response = Http::get("https://openlibrary.org/subjects/{$category}.json");

        if ($response->failed()) {
            return response()->json(['error' => 'could not access API data'], 500);
        }

        // Retornar os dados em JSON
        return response()->json($response->json());
    }
}

