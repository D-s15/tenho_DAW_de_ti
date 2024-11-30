<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getApi()
    {
        // Faz a requisição GET na API
        $response = Http::get('https://openlibrary.org/api/books');
        dd($response->json());
        
        // Verifica se deu tudo certo
        if ($response->successful()) {
            // Retorna os dados da API
            return view('api', ['api' => $response->json()]);
        } else {
            // Tratar erros (pode personalizar)
            return response()->json([
                'message' => 'Erro ao consumir API!',
                'status' => $response->status(),
            ]);
        }
    }
}
