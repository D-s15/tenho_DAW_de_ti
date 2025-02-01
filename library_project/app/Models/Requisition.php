<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    protected $tableName ="requisitions";
    protected $primaryKey = "requisition_id";

    protected $fillable = [
        'reader_id', 'book_id', 'request_status', 'loan_date', 'return_date', 'delay', 'price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
