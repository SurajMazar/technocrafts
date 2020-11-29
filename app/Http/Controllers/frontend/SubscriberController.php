<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subscriber;

class SubscriberController extends Controller
{
    public function create(Request $request){
    	$this->validate($request,[
    		'email'=> 'required| unique:subscribers'
    	]);

    	Subscriber::create([
    		'email'=>$request['email']
    	]);
    }
}
