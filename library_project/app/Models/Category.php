<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $tableName ="categories";
    protected $primaryKey = "category_id";

    protected $fillable = [];
}
