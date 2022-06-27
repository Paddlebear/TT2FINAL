<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReadingList;
use App\Models\Tag;
use App\Models\Genre;

class Book extends Model
{
    use HasFactory;
    //FK relationships - assigned to pivot tables
    public function reading_lists()
    {
        return $this->belongsToMany(ReadingList::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function genres()
    {
        return $this->hasMany(Genre::class);
    }
}
