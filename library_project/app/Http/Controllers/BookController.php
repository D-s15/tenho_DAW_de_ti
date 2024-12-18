<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;

class BookController extends Controller
{
    protected $apiController;

    public function __construct(ApiController $apiController)
    {
        $this->apiController = $apiController;
    }

    public function store(Request $request, $isbn){
        // Chamar o método getBookData do ApiController para obter os dados
        $bookData = $this->apiController->getBookData($isbn)->getData();

        // Acessar os dados do livro usando a chave ISBN:{isbn}
        $bookData = $bookData->{'ISBN:' . $isbn};  // Acessar a chave dinâmica

        $isbnKey = null;

    // Percorrer os identifiers para encontrar o ISBN correspondente
    foreach ($bookData->identifiers as $key => $values) {
        // Verificar se algum dos valores (isbn_10 ou isbn_13) é igual ao ISBN da URL
        if (in_array($isbn, $values)) {
            $isbnKey = $isbn;
            break;  // Encerra o loop ao encontrar o ISBN
        }
    }

    // Se não encontrou o ISBN correspondente
    if (!$isbnKey) {
        return redirect()->route('home')->withErrors('ISBN não encontrado entre os identifiers.');
    }
        // Validar os dados da API (exemplo de validação simples)
        $validatedData = [       
            'ISBN' => $isbnKey ?? null,
            'title' => $bookData->title ?? '',
            'page_number' => $bookData->number_of_pages ?? null,
            'author' => implode(', ', array_map(function($author) {
                return $author->name; // Usando a sintaxe de objeto
            }, $bookData->authors ?? [])),
            'publisher' => $bookData->publishers[0]->name ?? '',
            'cover' => $bookData->cover->large ?? '',
            'release_date' => $bookData->publish_date ?? '',
            'edition' => $bookData->edition ?? 1,
            'sinopse' => $bookData->notes ?? 'No description available',
            'available' => true,  // Exemplo de valor padrão
            'stock' => 10,  // Exemplo de valor padrão
        ];

        // Se algum dado essencial estiver faltando, retornar um erro
        if (!$validatedData['ISBN'] || !$validatedData['title']) {
            return response()->json([
                'message' => 'Dados do livro inválidos ou incompletos.',
                'bookData' => $bookData,
                'book' => $validatedData
            ], 400);
        }

        // Criar um novo livro com os dados validados
        $book = Book::create($validatedData);

        // Retornar a resposta com o livro criado
        return response()->json([
            'message' => 'Livro criado com sucesso!',
            'book' => $book,
        ], 201);
    }


    public function show($isbn)
    {
        $book = Book::where('ISBN', $isbn)->first();

        if (!$book) {
            return redirect()->route('home')->withErrors('Livro não encontrado!');
        }

        return view('books.show', ['book' => $book]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
