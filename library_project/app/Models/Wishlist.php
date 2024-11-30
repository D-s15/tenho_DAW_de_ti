<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $tableName ="wishlists";
    protected $primaryKey = "wishlist_id";

    protected $fillable = [];
}
