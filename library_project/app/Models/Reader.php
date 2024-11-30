<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $tableName ="readers";
    protected $primaryKey = "reader_id";

    protected $fillable = [];
}
