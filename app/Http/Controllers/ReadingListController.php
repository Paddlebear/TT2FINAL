<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\ReadingList;
use App\Models\User;
use App\Models\Book;
use App\Models\Tag;
use Illuminate\Http\Request;

class ReadingListController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $lists = DB::table('reading_lists')->join('users', 'reading_lists.user_id', '=', 'users.id')
                        ->select('reading_lists.id', 'reading_lists.listname', 'users.name', 'reading_lists.description')->where('reading_lists.visible', '=', 1)->get();
        //$lists = ReadingList::all();
        return view('all_reading_lists', compact('lists'));
    }

    public function showlist($listname) {
        $list = DB::table('reading_lists')->join('users', 'reading_lists.user_id', '=', 'users.id')->select('reading_lists.*', 'users.name')->where('listname', '=', $listname)->get(); //->value('id');
        $id = $list[0]->id;
        $books = DB::table('book_reading_list')->join('books', 'book_reading_list.book_id', '=', 'books.id')->join('genres', 'books.genre_id', '=', 'genres.id')->
                        select('books.booktitle', 'books.author', 'books.publicationyear', 'genres.genrename')->where('reading_list_id', '=', $id)->get();
        $tags = DB::table('reading_list_tag')->join('tags', 'reading_list_tag.tag_id', '=', 'tags.id')->select('tags.tagname')->where('reading_list_id', '=', $id)->get();
        return view('reading_list', ['books' => $books, 'tags' => $tags, 'list' => $list]);
        return view('reading_list', compact('list'), compact('books'));
    }

//    public function userlist($name)
//    {
//        return view('user_lists');
//    }
    public function userlist($name) {
        $users = DB::table('users')->select('users.*')->where('name', '=', $name)->get();
        $user = $users[0];
        //$id = $user[0]->id;
        $lists = DB::table('reading_lists')->join('users', 'reading_lists.user_id', '=', 'users.id')
                        ->select('reading_lists.*', 'users.name')->where('users.name', '=', $name)->get();
        return view('user_lists', ['lists' => $lists, 'user' => $user]);
        //return view('user_lists', ['user' => $name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) {
        $user = User::findOrFail($id);
        return view('new_reading_list', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = array(
            'listname' => 'required|min:2|max:200',
            'description' => 'min:0|max:2000',
            'user_id' => 'required|exists:users,id',
            'visible' => 'required'
        );
        $this->validate($request, $rules);
        $list = new ReadingList();
        $list->listname = $request->listname;
        $list->description = $request->description; //possibly wrong
        $list->user_id = $request->user_id;
        $list->visible = $request->visible;
        $list->save();
        return redirect('/'); //change the redirect later
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $list = ReadingList::findOrFail($id);
        return view('edit_reading_list', compact('list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($bookid, $userid) {
        $book = Book::findOrFail($bookid);
        $lists = DB::table('reading_lists')->select('reading_lists.id', 'reading_lists.listname')->where('reading_lists.user_id', '=', $userid)->get();
//       $lists = $userlists->map(function ($list) {
//            $list->value = $list->id;
//            return $list;
//	   });
        return view('add_books_to_list', ['lists' => $lists, 'book' => $book, 'userid' => $userid]);
    }

    public function addlist(Request $request) {
//        $rules = array(
//            'reading_list_id' => 'required|exists:book_reading_list,reading_list_id',
//            'book_id' => 'required|exists:book_reading_list,book_id'
//        );
//        $this->validate($request, $rules);
//        $listid = $request->reading_list_id;
//        $bookid = $request->book_id;
//        DB::insert('insert into book_reading_list (book_id, reading_list_id) values (?, ?)', [$bookid, $listid]);
        $listid = $request->reading_list_id;
        $bookid = $request->book_id;
        $list = ReadingList::findOrFail($listid);
        if (!$list->books()->where('book_id', $bookid)->exists()) {
            $list->books()->attach($bookid);
            return redirect('/');
        } else {
            return redirect('/books')->with('alert', 'The book is already in that list.');
        }
    }

    public function edittags($listid) {
        $list = ReadingList::findOrFail($listid);
        $tags = DB::table('tags')->select('tags.id', 'tags.tagname')->where('tags.id', '!=', 1)->get();
        return view('add_tag_to_list', ['list' => $list, 'tags' => $tags]);
    }

    public function addlisttags(Request $request) {
        $listid = $request->reading_list_id;
        $tagid = $request->tag_id;
        $list = ReadingList::findOrFail($listid);
        if (!$list->tags()->where('tag_id', $tagid)->exists()) {
            $list->tags()->attach($tagid);
            return redirect('/');
        } else {
            return redirect('/books')->with('alert', 'The tag is already on that list.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $rules = array(
            'listname' => 'required|min:2|max:200',
            'description' => 'min:0|max:2000',
            'user_id' => 'required|exists:users,id',
            'visible' => 'required'
        );
        $this->validate($request, $rules);
        $list = ReadingList::find($request->id);
        $list->listname = $request->listname;
        $list->description = $request->description; //possibly wrong
        $list->user_id = $request->user_id;
        $list->visible = $request->visible;
        $list->save();
        return redirect('/'); //change the redirect later
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showdelete($id) {
        $list = ReadingList::findOrFail($id);
        return view('delete_reading_list', compact('list'));
    }

    public function destroy($id) { ///also needs deletion of pivot table data
        DB::table('book_reading_list')->where('reading_list_id', '=', $id)->delete();
        DB::table('reading_list_tag')->where('reading_list_id', '=', $id)->delete();
        ReadingList::findOrFail($id)->delete();
        return redirect('/');
    }
    public function showFilter()
    {
        $tags = DB::table('tags')->select('tags.id', 'tags.tagname')->get();
        return view('filterlists', compact('tags'));
    }
    public function filter(Request $request)
    {
        $rules = array(
                'listname' => 'nullable|min:2|max:100',
                'name' => 'nullable|min:2|max:100',
                'tag_id' => 'nullable|exists:genres,id'
            );
        $this->validate($request, $rules);
        $tagid = $request->tag_id;
        //$query = DB::table('users')->join('reading_lists', 'users.id', '=', 'reading_lists.user_id')->
                //join('reading_list_tag', 'reading_lists.id', '=', 'reading_list_tag.reading_list_id')->
                //select('reading_lists.*', 'users.name')->get();
        $query = User::join('reading_lists', 'users.id', '=', 'reading_lists.user_id');
        $query = $query->join('reading_list_tag', 'reading_lists.id', '=', 'reading_list_tag.reading_list_id');
        if ($request->listname != null) {
            $query = $query->where('reading_lists.listname', 'LIKE', '%' . $request->listname . '%');
        }
        if ($request->name != null) {
            $query = $query->where('users.name', 'LIKE', '%' . $request->name . '%');
        }
        if ($tagid != null && $tagid > 1) {
            $query = $query->where('reading_list_tag.tag_id','=',$tagid);
        }
        $query = $query->select('reading_lists.*', 'users.name')->where('reading_lists.visible','=', 1);
        return view('searchlists', array('lists' => $query->get()));
    }
}
