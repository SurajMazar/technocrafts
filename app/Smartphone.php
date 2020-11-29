<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Smbrand;
use Illuminate\Database\Eloquent\Model;

class Smartphone extends Model
{
	use SoftDeletes;

   protected $guarded=[];

   public function brand(){
   	return $this->belongsTo(Smbrand::class,'smbrand_id');
   }
}
