<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    
    protected $tableName ="books";
    protected $primaryKey ="ISBN";

     // Definir os campos que são atribuíveis em massa
     protected $fillable = [
        'ISBN',
        'title',
        'page_number',
        'author',
        'publisher',
        'cover',
        'release_date',
        'edition',
        'sinopse',
        'available',
        'stock',
    ];
}
