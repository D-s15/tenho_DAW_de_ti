<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $table = 'requests';

    protected $fillable = [
        'request_type',
        'request_date',
        'status',
        'library_user_id',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_requests', 'request_id', 'book_id');
    }

    public function libraryUser()
    {
        return $this->belongsTo(LibraryUser::class, 'library_user_id');
    }
}
