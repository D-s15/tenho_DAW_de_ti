<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    
    protected $tableName ="books";
    protected $primaryKey ="ISBN";
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ISBN', 'title', 'page_number', 'author', 'publisher', 'cover', 'release_date', 
        'edition', 'sinopse', 'available', 'stock'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category', 'book_id', 'category_id');
    }

    public function wishlists()
    {
        return $this->belongsToMany(Wishlist::class, 'book_wishlist', 'book_id', 'wishlist_id');
    }

    public function requisitions()
    {
        return $this->hasMany(Requisition::class);
    }
}
