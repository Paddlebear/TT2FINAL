<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Book;
use App\Models\ReadingList;
use App\Models\Genre;
use App\Models\Tag;

class AdminController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        // only Admins have access to the following methods
        $this->middleware('auth.admin');
    }

    public function index() {
        //
    }

    public function adminlist() {
        $lists = ReadingList::all();
        $lists = DB::table('reading_lists')->join('users', 'reading_lists.user_id', '=', 'users.id')
                        ->select('reading_lists.*', 'users.name')->get();
        return view('admin_list', compact('lists'));
    }

    public function adminbook() {
        $books = DB::table('books')->join('genres', 'books.genre_id', '=', 'genres.id')->
                        select('books.*', 'genres.genrename')->orderBy('books.id')->get();
        return view('admin_book', compact('books'));
    }

    public function adminuser() {
        $users = User::all();
        return view('user_control', compact('users'));
    }

    public function admintags() {
        $tags = Tag::all();
        return view('admin_tags', compact('tags'));
    }

    public function admingenres() {
        $genres = Genre::all();
        return view('admin_genres', compact('genres'));
    }

    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showdelete($id) {
        $user = User::findOrFail($id);
        return view('user_removal', compact('user'));
    }

    public function destroy($id) { //only destroys users
        DB::table('reading_list_tag')->join('reading_lists', 'reading_list_tag.reading_list_id', '=', 'reading_lists.id')->where('reading_lists.user_id', '=', $id)->delete();
        DB::table('book_reading_list')->join('reading_lists', 'book_reading_list.reading_list_id', '=', 'reading_lists.id')->where('reading_lists.user_id', '=', $id)->delete();
        DB::table('reading_lists')->where('user_id', '=', $id)->delete();
        User::findOrFail($id)->delete();
        return redirect('/');
    }

}
