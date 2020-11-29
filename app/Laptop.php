<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Brand;

class Laptop extends Model
{
    use SoftDeletes;

	protected $data=['deleted_at'];
	protected $guarded=[];

	public function laptopbrand(){
		return $this->belongsToMany(Brand::class);
	}
}
