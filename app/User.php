<?php

namespace App;

use App\Notifications\VerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //relation one to many
    public function posts(){
    	return $this->hasMany('App\Post');
    }

	/**
	 * @return bool if user is verified
	 */
	public function verified(){
    	return $this->token === null;
    }

	/**
	 * Send the user a verification email
	 *
	 * @return void
	 */

	public function sendVerificationEmail(){
	    $this->notify(new VerifyEmail($this));
    }

}
