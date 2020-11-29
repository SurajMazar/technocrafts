<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BlogCategory;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
	use SoftDeletes;

	protected $data=['deleted_at'];

	protected $table='blog';
	protected $guarded=[];

	public function blogcategory(){
		return $this->belongsToMany(BlogCategory::class);
	}

	public function bloguser(){
		return $this->belongsToMany(User::class);
	}
}
