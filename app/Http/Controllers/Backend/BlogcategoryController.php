<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BlogCategory;

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
  	return BlogCategory::orderBy('name','asc')->with('blogcategory')->paginate(10);
  }

  public function allblogcategories(){
    return BlogCategory::orderBy('name','asc')->get();
  }

  public function create(Request $request){
  	$this->validate($request,[
  		'name'=>'required',
  		'slug'=>'required|unique:blogcategory'
  	]);

    BlogCategory::create([
    	'name'=>$request['name'],
    	'slug'=>$request['slug'],
    	'description'=>$request['description'],
    ]);

  }


  public function show($id){
    return BlogCategory::findOrFail($id);
  }


  public function update(Request $request,$id){
    $this->validate($request,[
      'name'=>'required',
      'slug'=>'required'
    ]);

    $cat = BlogCategory::findOrFail($id);

    $cat->update([
      'name'=>$request['name'],
      'slug'=>$request['slug'],
      'description'=>$request['description'],
    ]);

  }


  public function delete($id){

    $cat = BlogCategory::findOrFail($id);

    $cat->delete();

    $cat->blogcategory()->detach();

  }
}
