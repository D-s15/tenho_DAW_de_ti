<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'ISBN',
        'title',
        'author',
        'publisher',
        'publication_year',
        'description',
        'cover_image',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories', 'book_ISBN', 'category_id');
    }

    public function wishlists()
    {
        return $this->belongsToMany(LibraryUser::class, 'book_wishlists', 'book_id', 'library_user_id');
    }

    public function Requests()
    {
        return $this->belongsToMany(Requests::class, 'book_requests', 'book_id', 'request_id'); 
    }
}
