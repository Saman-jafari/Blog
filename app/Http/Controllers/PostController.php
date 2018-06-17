<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use storage for delete function
use Illuminate\Support\Facades\Storage;

//this brings the model here
use App\Post;

//if you need sql query
//use DB;

class PostController extends Controller
{


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth', ['except'=> ['index', 'show']]);
	}

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
	        'body' => 'required',
	        'cover_image' => 'image|required|max:1999'
        ]);
        //handle file upload
	    if ($request->hasFile('cover_image')){
	    	// get file name with ext
		    $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
		    //get Just file Name
		    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
		    //get Ext
		    $extention = $request->file('cover_image')->getClientOriginalExtension();

		    //Filename to store

		    $fileNameToStore = $filename.'_'.time().'.'.$extention;
		    //upload img

		    $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

		    //to create simlink do this on terminal php artisan storage:link
	    } else {
	    	$fileNameToStore = 'noimage.png';
	    }


        //create POst
	    $post = new Post();
	    $post->title = $request->input('title');
	    $post->body = $request->input('body');
	    $post->user_id = auth()->user()->id;
	    $post->cover_image = $fileNameToStore;
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

	    $post = Post::find($id);

	    //check for correct user
	    if(auth()->user()->id !==  $post->user_id){
	    	return redirect('/posts')->with('error', 'Unauthorized Page');
	    }

	    return view('posts.edit')->with('post',$post);
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
	    //validate form
	    $this->validate($request, [
		    'title' => 'required',
		    'body' => 'required',
		    'cover_image' => 'image|max:1999'

	    ]);

	    //handle file upload
	    if ($request->hasFile('cover_image')){
		    // get file name with ext
		    $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
		    //get Just file Name
		    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
		    //get Ext
		    $extention = $request->file('cover_image')->getClientOriginalExtension();

		    //Filename to store

		    $fileNameToStore = $filename.'_'.time().'.'.$extention;
		    //upload img

		    $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

		    //to create simlink do this on terminal php artisan storage:link
	    }

	    //create POst
	    $post = Post::find($id);
	    $post->title = $request->input('title');
	    $post->body = $request->input('body');
	    if ($request->hasFile('cover_image')){
	    	$post->cover_image = $fileNameToStore;
	    }
	    $post->save();

	    return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
	    if(auth()->user()->id !==  $post->user_id){
		    return redirect('/posts')->with('error', 'Unauthorized Page');
	    }
	    if ($post->cover_image != 'noimage.png'){
	    	//Delete image
		    Storage::delete('public/cover_images'. $post->cover_images);
	    }
        $post->delete();
        return redirect('/posts')->with('success','Post Removed');
    }
}
