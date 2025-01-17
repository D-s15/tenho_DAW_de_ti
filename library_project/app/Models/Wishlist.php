<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $tableName ="wishlists";
    protected $primaryKey = "wishlist_id";

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_wishlist', 'wishlist_id', 'book_id');
    }

    public function user()
    {
        return $this->belongsTo(Reader::class);
    }
}
