<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\Tag;

class ReadingList extends Model
{
    use HasFactory;
    //FK relationships - assigned to pivot tables
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
