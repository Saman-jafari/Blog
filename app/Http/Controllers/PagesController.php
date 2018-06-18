<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
    	$title = 'Welcome to 8memesaday Admin';
//    	return view('pages.index', compact($title));
    	return view('pages.index')->with('title',$title);
    }

    public function about(){
	    $title = 'Welcome to about';
    	return view('pages.about')->with('title', $title);
    }

    public function services(){
	    $data = array(
	    	'title'=>'Services',
		    'services' => ['Web Design', 'Blah']
	    );
    	return view('pages.services')->with($data);
    }
}
