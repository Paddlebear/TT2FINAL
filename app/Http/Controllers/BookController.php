<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = DB::table('books')->join('genres', 'books.genre_id', '=', 'genres.id')->
                select('books.booktitle', 'books.author', 'books.publicationyear', 'genres.genrename')->orderBy('books.id')->get();
        return view('all_books', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all()->map(function ($genre) {
            $genre->value = $genre->id;
            return $genre;
	   });
        return view('add_book', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'booktitle' => 'required|min:2|max:200',
            'author' => 'required|min:2|max:200',
            'publicationyear' => 'required|integer|min:0|max:2025',
            'genre_id' => 'required|exists:genres,id'
        );
        $this->validate($request, $rules);
        $book = new Book();
        $book->booktitle = $request->booktitle;
        $book->author = $request->author;
        $book->publicationyear = $request->publicationyear;
        $book->genre_id = $request->genre_id;
        $book->save();
        return redirect('/'); //change the redirect later
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) ///only available for admins
    {
        $book = Book::findOrFail($id);
        return view('edit_book', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) ///only available for admins
    {
        $rules = array(
            'booktitle' => 'required|min:2|max:200',
            'author' => 'required|min:2|max:200',
            'publicationyear' => 'required|integer|min:0|max:2025',
            'genre_id' => 'required|exists:genres,id'
        );
        $this->validate($request, $rules);
        $book = Book::find($request->id);
        $book->booktitle = $request->booktitle;
        $book->author = $request->author;
        $book->publicationyear = $request->publicationyear;
        $book->genre_id = $request->genre_id;
        $book->save();
        return redirect('/'); //change the redirect later
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) ///only available for admins
    {
        DB::table('book_tag')->where('book_id', '=', $id)->delete();
        Book::findOrFail($id)->delete();
        return redirect('/'); //this def needs to be changed
    }
}
