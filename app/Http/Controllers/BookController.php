<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Tag;

class BookController extends Controller
{
    public function __construct() {
        // only Admins have access to the following methods
        $this->middleware('auth.admin')->only(['show', 'update', 'destroy', 'destroytag']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = DB::table('books')->join('genres', 'books.genre_id', '=', 'genres.id')->
                select('books.*', 'genres.genrename')->orderBy('books.id')->get();
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
        $genres = Genre::all()->map(function ($genre) {
            $genre->value = $genre->id;
            return $genre;
	   });
        return view('edit_book', ['book' => $book, 'genres' => $genres]);
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
    public function update(Request $request) ///only available for admins
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
        DB::table('book_reading_list')->where('book_id', '=', $id)->delete();
        Book::findOrFail($id)->delete();
        return redirect('/'); //this def needs to be changed
    }
    public function showFilter()
    {
        $genres = Genre::all()->map(function ($genre) {
            $genre->value = $genre->id;
            return $genre;
	   });
        return view('filterbooks', compact('genres'));
    }
    public function filter(Request $request)
    {
        $rules;
        if ($request->year_from != null) {
            $year_from = $request->year_from;
            $rules = array(
                'title' => 'nullable|min:2|max:100',
                'author' => 'nullable|min:2|max:100',
                'year_from' => 'nullable|integer|min:0|max:'.(date('Y')),
                'year_until' => 'nullable|integer|min:0|max:'.date('Y').'|gte:'.($year_from),
                'genre_id' => 'nullable|exists:genres,id'
            );
        } else {
            $rules = array(
                'title' => 'nullable|min:2|max:100',
                'author' => 'nullable|min:2|max:100',
                'year_from' => 'nullable|integer|min:0|max:'.(date('Y')),
                'year_until' => 'nullable|integer|min:0|max:'.date('Y'),
                'genre_id' => 'nullable|exists:genres,id'
            );
        }
        $this->validate($request, $rules);
        $genreid = $request->genre_id;
        $query = Book::join('genres', 'genres.id', '=', 'books.genre_id');
        if ($genreid != null && $genreid > 1) {
            $query = $query->where('books.genre_id','=',$genreid);
        }
        if ($request->booktitle != null) {
            $query = $query->where('books.booktitle', 'LIKE', '%' . $request->booktitle . '%');
        }
        if ($request->author != null) {
            $query = $query->where('books.author', 'LIKE', '%' . $request->author . '%');
        }
        if ($request->year_from != null) {
            $query = $query->where('books.publicationyear', '>=', $request->year_from);
        }

        if ($request->year_until != null) {
            $query = $query->where('books.publicationyear', '<=', $request->year_until);
        }
        $query = $query->select('books.*', 'genres.genrename');
        //echo $request->year_from;
        return view('searchbooks', array('books' => $query->orderBy('id')->get()));
    }
}
