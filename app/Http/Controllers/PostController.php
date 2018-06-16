<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//this brings the model here
use App\Post;

//if you need sql query
//use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * //create by php artisan make:controller PostController --resource
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//	    $posts = Post::orderBy('title','desc')->get();

	    // let program know how many of row must be get from model db
//	    $posts = Post::orderBy('title','desc')->take(1)->get();
	    // $posts = Post::all();
	    //search or get post by title
	    //Post::where('title', 'post tow');

	    //if you need to Use query
	    //$posts = DB::select('SELECT * FROM posts');

	    //add pagination really easyly
	    $posts = Post::orderBy('created_at','desc')->paginate(5);

	    return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	//validate form
        $this->validate($request, [
        	'title' => 'required',
	        'body' => 'required'
        ]);
        //create POst
	    $post = new Post();
	    $post->title = $request->input('title');
	    $post->body = $request->input('body');
	    $post->save();

        return redirect('/posts')->with('success', 'Post Created');
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
	    $post = Post::find($id);
	    return view('posts.show')->with('post', $post);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
