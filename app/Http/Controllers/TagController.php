<?php 
 /*this one mainly exists for testing purposes. this code should be put in the admin controller, honestly.*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        // only Admins have access to the following methods
        $this->middleware('auth.admin');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_tag');
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
            'tagname' => 'required|min:2|max:100',
        );
        $this->validate($request, $rules);
        $tag = new Tag();
        $tag->tagname = $request->tagname;
        $tag->save();
        return redirect('/'); //change the redirect later
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    public function showdelete($id)
    {
        $tag = Tag::findOrFail($id);
        return view('delete_tag', compact('tag'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('book_tag')->where('tag_id', '=', $id)->delete();
        DB::table('reading_list_tag')->where('tag_id', '=', $id)->delete();
        Tag::findOrFail($id)->delete();
        return redirect('/');
    }
}
