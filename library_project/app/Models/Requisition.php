<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    protected $tableName ="requisitions";
    protected $primaryKey = "requisition_id";

    protected $fillable = [];
}
