<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Writing;

class WritingController extends Controller
{
    public function create(Request $request){

    	$this->validate($request,[
    		'name'=>'required',
    		'email'=>'required',
    		'contact'=>'required',
    		'title'=>'required',
    		'content'=>'required',
    	]);


    	Writing::create([
    		'name'=>$request['name'],
    		'email'=>$request['email'],
    		'contact'=>$request['contact'],
    		'status'=>'Under review',
    		'title'=>$request['title'],
    		'content'=>$request['content'],
    	]);

    }
}
