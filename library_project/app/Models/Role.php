<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $tableName ="roles";
    protected $primaryKey = "role_id";
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(Reader::class);
    }
}
