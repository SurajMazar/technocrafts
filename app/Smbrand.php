<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Smartphone;

class Smbrand extends Model
{
	use SoftDeletes;

   protected $guarded=[];

   protected $table = 'smartphonebrands';

   public function smartphones(){
   	return $this->hasMany(Smartphone::class);
   }
}
