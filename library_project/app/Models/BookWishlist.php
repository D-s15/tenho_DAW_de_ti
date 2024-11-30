<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookWishlist extends Model
{
    protected $tableName = "Book_Wishlists";
    protected $primaryKey = ["wishlist_id", "ISBN"];

    protected $fillable = [];
}
