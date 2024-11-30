<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    
    protected $tableName ="books";
    protected $primaryKey ="ISBN";

    protected $fillable = [];
}
