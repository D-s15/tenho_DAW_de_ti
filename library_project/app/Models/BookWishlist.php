<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookWishlist extends Model
{
    protected $tableName = "Book_Wishlists";
    protected $primaryKey = ["wishlist_id", "ISBN"];

    public $incrementing = false;
    
    protected $fillable = ['wishlist_id', 'book_id'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class, 'wishlist_id');
    }
}
