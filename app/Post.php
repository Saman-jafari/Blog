<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //TableName
	protected $table = 'posts';
	//Primary Key
	public $primaryKey = 'id';
	//time Stamps
	public $timestamps = true;
}
