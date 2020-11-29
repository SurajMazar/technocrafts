<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Noticeboard extends Model
{
	protected $table = 'noticeboard';
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
	
}
