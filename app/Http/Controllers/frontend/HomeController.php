<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\Blogcategory;
use App\Laptop;
use PDF;
use App\Smartphone;
class HomeController extends Controller
{
	//home page
  public function home(){
  	$blogs= Blog::latest()->with('blogcategory','bloguser')->paginate(4);
  	$featured_blogs=Blog::latest()->with('blogcategory','bloguser')->where('featured',true)->paginate(6);
  	$laptops=Laptop::latest()->with('laptopbrand')->paginate(4);

    $mostViewed= Blog::orderBy('views','desc')->with('blogcategory','bloguser')->paginate(4);

    $smartphones=Smartphone::latest()->with('brand')->paginate(6);

      foreach( $smartphones as $smartphone){
        $smartphone->images=unserialize($smartphone->images);
      }

  	return view('welcome',compact('blogs','featured_blogs','laptops','smartphones','mostViewed'));
  }


  //compare gadget page
  public function compare_gadget(){

  	return view('frontend.compare-gadget.index');
  }
  //compare gadget page


  public function laptop($id){

      $laptops=Laptop::latest()->with('laptopbrand');

      $first_laptop=$laptops->findOrFail($id);

      return $first_laptop;
  }

  public function smartphone($id){

      $smartphones=Smartphone::latest()->with('brand');

      $smartphone=$smartphones->findOrFail($id);

      $smartphone->images=unserialize($smartphone->images);
     
      return $smartphone;
  }


  public function becmeWriter(){
    return view('frontend.become-a-writer.index');
  }



}
