<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    protected $tableName ="book_category";
    protected $primaryKey ="ISBN";

    protected $fillable = [];
}
