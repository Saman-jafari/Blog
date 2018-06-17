<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
	/**
	 *
	 * Verify the user with a given token
	 * @param $token
	 *
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function verify($token){
    	//php artisan migrate:fresh reset db
    	User::where('token', $token)->firstOrFail()
    	->update(['token'=> null]);

    	return redirect()
		    ->route('home')
		    ->with('success', 'Account verified');
    }
}
