<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class LibraryUser extends Authenticatable
{
    use Notifiable;
    protected $table = 'library_users';

    protected $fillable = [
        'user_type',
        'username',
        'email',
        'password',
        'phone',
    ];

     protected $hidden = [
        'password',
        'remember_token',
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
