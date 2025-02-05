<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    protected $tableName ="book_categories";
    protected $primaryKey =["ISBN", "category_id"];

    public $incrementing = false;

    protected $fillable = ['ISBN','category_id'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
