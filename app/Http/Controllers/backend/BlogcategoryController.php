<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blogcategory;

class BlogcategoryController extends Controller
{
   public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(){
  	return view('admin.blogs.blogcategory');
  }

  public function blogcategories(){
  	return Blogcategory::orderBy('name','asc')->with('blogcategory')->paginate(10);
  }

  public function allblogcategories(){
    return Blogcategory::orderBy('name','asc')->get();
  }

  public function create(Request $request){
  	$this->validate($request,[
  		'name'=>'required',
  		'slug'=>'required|unique:blogcategory'
  	]);

    Blogcategory::create([
    	'name'=>$request['name'],
    	'slug'=>$request['slug'],
    	'description'=>$request['description'],
    ]);

  }


  public function show($id){
    return Blogcategory::findOrFail($id);
  }


  public function update(Request $request,$id){
    $this->validate($request,[
      'name'=>'required',
      'slug'=>'required'
    ]);

    $cat = Blogcategory::findOrFail($id);

    $cat->update([
      'name'=>$request['name'],
      'slug'=>$request['slug'],
      'description'=>$request['description'],
    ]);

  }


  public function delete($id){

    $cat = Blogcategory::findOrFail($id);

    $cat->delete();

    $cat->blogcategory()->detach();

  }
}
