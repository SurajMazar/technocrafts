<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Blog;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    protected $table='blogcategory';

    protected $guarded=[];

    public function blogcategory(){
		return $this->belongsToMany(Blog::class);
	}
}
