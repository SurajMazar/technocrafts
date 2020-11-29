<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Advertisementcategory;

class Advertisement extends Model
{
    use SoftDeletes;

	protected $data=['deleted_at'];

	protected $guarded=[];

	public function adsCategory(){
		return $this->belongsToMany(Advertisementcategory::class);
	}

}
