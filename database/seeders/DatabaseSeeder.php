<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Tag;
use App\Models\ReadingList;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $user = User::create([
            'name' => 'testuser',
            'email' => 'test@example.com',
            'password' => bcrypt('secret')
        ]);
        DB::table('genres')->insert(['genrename' => 'Romance']);
        DB::table('genres')->insert(['genrename' => 'Fantasy']);
        DB::table('genres')->insert(['genrename' => 'Young Adult']);
        DB::table('genres')->insert(['genrename' => 'Dystopian']);
        DB::table('genres')->insert(['genrename' => 'Coming-of-age']);
        DB::table('genres')->insert(['genrename' => 'Mystery']);
        DB::table('genres')->insert(['genrename' => 'Crime']);
        DB::table('genres')->insert(['genrename' => 'Science fiction']);
        DB::table('genres')->insert(['genrename' => 'Horror']);
        DB::table('genres')->insert(['genrename' => 'Historical']);
        DB::table('genres')->insert(['genrename' => 'Drama']);
        $book = Book::create([
            'booktitle' => 'Golden Days',
            'author' => 'Cullie',
            'publicationyear' => 2020,
            'genre_id' => 1
            ]);
        $book = Book::create([
            'booktitle' => 'Flash in the Night',
            'author' => 'Cullie',
            'publicationyear' => 2022,
            'genre_id' => 1
            ]);
        $book = Book::create([
            'booktitle' => 'The Benefits of Heartbreak',
            'author' => 'Kihyunie',
            'publicationyear' => 2019,
            'genre_id' => 1
            ]);
        $book = Book::create([
            'booktitle' => 'Harry Potter and the Sorcerer’s Stone',
            'author' => 'J.K. Rowling',
            'publicationyear' => 1997,
            'genre_id' => 2
            ]);
        $book = Book::create([
            'booktitle' => 'Harry Potter and the Chamber of Secrets',
            'author' => 'J.K. Rowling',
            'publicationyear' => 1998,
            'genre_id' => 2
            ]);
        $book = Book::create([
            'booktitle' => 'Harry Potter and the Prisoner of Azkaban',
            'author' => 'J.K. Rowling',
            'publicationyear' => 1999,
            'genre_id' => 2
            ]);
        $book = Book::create([
            'booktitle' => 'Harry Potter and the Goblet of Fire',
            'author' => 'J.K. Rowling',
            'publicationyear' => 2000,
            'genre_id' => 2
            ]);
        $book = Book::create([
            'booktitle' => 'Harry Potter and the Order of the Phoenix',
            'author' => 'J.K. Rowling',
            'publicationyear' => 2003,
            'genre_id' => 2
            ]);
        $book = Book::create([
            'booktitle' => 'Harry Potter and the Half-Blood Prince',
            'author' => 'J.K. Rowling',
            'publicationyear' => 2005,
            'genre_id' => 2
            ]);
        $book = Book::create([
            'booktitle' => 'Harry Potter and the Deathly Hallows',
            'author' => 'J.K. Rowling',
            'publicationyear' => 2007,
            'genre_id' => 2
            ]);
        $book = Book::create([
            'booktitle' => 'Harry Potter and the Cursed Child',
            'author' => 'J.K. Rowling',
            'publicationyear' => 2016,
            'genre_id' => 2
            ]);
        $book = Book::create([
            'booktitle' => 'The Hunger Games',
            'author' => 'Suzanne Collins',
            'publicationyear' => 2008,
            'genre_id' => 3
            ]);
        $book = Book::create([
            'booktitle' => 'Catching Fire',
            'author' => 'Suzanne Collins',
            'publicationyear' => 2009,
            'genre_id' => 3
            ]);
        $book = Book::create([
            'booktitle' => 'Mockingjay',
            'author' => 'Suzanne Collins',
            'publicationyear' => 2010,
            'genre_id' => 3
            ]);
        $book = Book::create([
            'booktitle' => 'Divergent',
            'author' => 'Veronica Roth',
            'publicationyear' => 2011,
            'genre_id' => 3
            ]);
        $book = Book::create([
            'booktitle' => 'Insurgent',
            'author' => 'Veronica Roth',
            'publicationyear' => 2012,
            'genre_id' => 3
            ]);
        $book = Book::create([
            'booktitle' => 'Allegiant',
            'author' => 'Veronica Roth',
            'publicationyear' => 2013,
            'genre_id' => 3
            ]);
        $book = Book::create([
            'booktitle' => '1984',
            'author' => 'George Orwell',
            'publicationyear' => 1949,
            'genre_id' => 4
            ]);
        $book = Book::create([
            'booktitle' => 'Animal Farm',
            'author' => 'George Orwell',
            'publicationyear' => 1945,
            'genre_id' => 4
            ]);
        $book = Book::create([
            'booktitle' => 'Catcher in the Rye',
            'author' => 'J. D. Salinger',
            'publicationyear' => 1951,
            'genre_id' => 5
            ]);
        $book = Book::create([
            'booktitle' => 'Da Vinci Code',
            'author' => 'Dan Brown',
            'publicationyear' => 2003,
            'genre_id' => 6
            ]);
        $book = Book::create([
            'booktitle' => 'It',
            'author' => 'Stephen King',
            'publicationyear' => 1986,
            'genre_id' => 9
            ]);
        $book = Book::create([
            'booktitle' => 'Twilight',
            'author' => 'Stephenie Meyer',
            'publicationyear' => 2005,
            'genre_id' => 1
            ]);
        $book = Book::create([
            'booktitle' => 'New Moon',
            'author' => 'Stephenie Meyer',
            'publicationyear' => 2006,
            'genre_id' => 1
            ]);
        $book = Book::create([
            'booktitle' => 'Eclipse',
            'author' => 'Stephenie Meyer',
            'publicationyear' => 2007,
            'genre_id' => 1
            ]);
        $book = Book::create([
            'booktitle' => 'Breaking Dawn',
            'author' => 'Stephenie Meyer',
            'publicationyear' => 2008,
            'genre_id' => 1
            ]);
        $book = Book::create([
            'booktitle' => 'Fifty Shades of Grey',
            'author' => 'E. L. James',
            'publicationyear' => 2011,
            'genre_id' => 1
            ]);
        $book = Book::create([
            'booktitle' => 'Lord of the Rings',
            'author' => 'J. R. R. Tolkien',
            'publicationyear' => 1955,
            'genre_id' => 2
            ]);
        $book = Book::create([
            'booktitle' => 'A Game of Thrones',
            'author' => 'George R. R. Martin',
            'publicationyear' => 1996,
            'genre_id' => 2
            ]);
        $book = Book::create([
            'booktitle' => 'A Clash of Kings',
            'author' => 'George R. R. Martin',
            'publicationyear' => 1998,
            'genre_id' => 2
            ]);
        $book = Book::create([
            'booktitle' => 'A Storm of Swords',
            'author' => 'George R. R. Martin',
            'publicationyear' => 2000,
            'genre_id' => 2
            ]);
        $book = Book::create([
            'booktitle' => 'A Feast for Crows',
            'author' => 'George R. R. Martin',
            'publicationyear' => 2005,
            'genre_id' => 2
            ]);
        $book = Book::create([
            'booktitle' => 'A Dance with Dragons',
            'author' => 'George R. R. Martin',
            'publicationyear' => 2011,
            'genre_id' => 2
            ]);
        $book = Book::create([
            'booktitle' => 'The Winds of Winter',
            'author' => 'George R. R. Martin',
            'publicationyear' => 2022,
            'genre_id' => 2
            ]);
        $book = Book::create([
            'booktitle' => 'The Kite Runner',
            'author' => 'Khaled Hosseini',
            'publicationyear' => 2003,
            'genre_id' => 5
            ]);
        $book = Book::create([
            'booktitle' => 'The Martian',
            'author' => 'Andy Weir',
            'publicationyear' => 2014,
            'genre_id' => 8
            ]);
        $book = Book::create([
            'booktitle' => 'Artemis',
            'author' => 'Andy Weir',
            'publicationyear' => 2017,
            'genre_id' => 8
            ]);
        $book = Book::create([
            'booktitle' => 'Project Hail Mary',
            'author' => 'Andy Weir',
            'publicationyear' => 2021,
            'genre_id' => 8
            ]);
        $book = Book::create([
            'booktitle' => 'Girl with the Dragon Tattoo',
            'author' => 'Stieg Larsson',
            'publicationyear' => 2008,
            'genre_id' => 6
            ]);
        $book = Book::create([
            'booktitle' => 'Looking for Alaska',
            'author' => 'John Green',
            'publicationyear' => 2005,
            'genre_id' => 3
            ]);
        $book = Book::create([
            'booktitle' => 'Paper Towns',
            'author' => 'John Green',
            'publicationyear' => 2008,
            'genre_id' => 3
            ]);
        $book = Book::create([
            'booktitle' => 'The Fault in our Stars',
            'author' => 'John Green',
            'publicationyear' => 2012,
            'genre_id' => 3
            ]);
        $book = Book::create([
            'booktitle' => 'Memoirs of a Geisha',
            'author' => 'Arthur Golden',
            'publicationyear' => 1997,
            'genre_id' => 10
            ]);
        $book = Book::create([
            'booktitle' => 'Empress Theresa',
            'author' => 'Norman Boutin',
            'publicationyear' => 2014,
            'genre_id' => 5
            ]);
        $book = Book::create([
            'booktitle' => 'To Kill a Mockingbird',
            'author' => 'Harper Lee',
            'publicationyear' => 1960,
            'genre_id' => 5
            ]);
        $book = Book::create([
            'booktitle' => 'Pride and Prejudice',
            'author' => 'Jane Austen',
            'publicationyear' => 1813,
            'genre_id' => 10
            ]);
        $book = Book::create([
            'booktitle' => 'The Lion, the Witch and the Wardrobe',
            'author' => 'C. S. Lewis',
            'publicationyear' => 1950,
            'genre_id' => 2
            ]);
        $book = Book::create([
            'booktitle' => 'The Perks of Being a Wallflower',
            'author' => 'Stephen Chbosky',
            'publicationyear' => 1999,
            'genre_id' => 5
            ]);
        $book = Book::create([
            'booktitle' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'publicationyear' => 1925,
            'genre_id' => 11
            ]);
        $book = Book::create([
            'booktitle' => 'Crime and Punishment',
            'author' => 'Fyodor Dostoevsky',
            'publicationyear' => 1866,
            'genre_id' => 11
            ]);
        $tag = Tag::create([
            'tagname' => 'tag1'
        ]);
        $tag = Tag::create([
            'tagname' => 'tag2'
        ]);
        $tag = Tag::create([
            'tagname' => 'tag3'
        ]);
        $readinglist = ReadingList::create([
            'listname' => 'Test list',
            'description' => 'Also known as fanfiction',
            'user_id' => 1,
            'visible' => 1
        ]);
        DB::table('book_reading_list')->insert(['reading_list_id' => 1, 'book_id' => 1]);
        DB::table('book_reading_list')->insert(['reading_list_id' => 1, 'book_id' => 2]);
        DB::table('book_reading_list')->insert(['reading_list_id' => 1, 'book_id' => 3]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
