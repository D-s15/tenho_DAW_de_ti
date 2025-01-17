<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $tableName ="readers";
    protected $primaryKey = "reader_id";

    protected $fillable = [
        'position_id', 'email', 'name', 'password', 'phone_number'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function requests()
    {
        return $this->hasMany(Requisition::class);
    }
}
