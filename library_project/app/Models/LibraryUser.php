<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryUser extends Model
{
    protected $table = 'library_users';

    protected $fillable = [
        'user_type',
        'name',
        'email',
        'password',
        'phone',
    ];

    public function wishlists()
    {
        return $this->belongsToMany(Book::class, 'book_wishlists', 'library_user_id', 'book_id');
    }

    public function requests()
    {
        return $this->belongsToMany(Request::class, 'library_user_requests', 'library_user_id', 'request_id');
    }
}
