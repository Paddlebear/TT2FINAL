<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\ReadingList;

class Tag extends Model
{
    use HasFactory;
    //FK relationships - assigned to pivot tables
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
    public function reading_lists()
    {
        return $this->belongsToMany(ReadingList::class);
    }
}
