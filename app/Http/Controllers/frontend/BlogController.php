<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Blog;
use App\Blogcategory;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;


class BlogController extends Controller
{
    // blogs page
  public function blogs(){
  	$blogs= Blog::latest()->with('blogcategory','bloguser')->paginate(12);
  	$blog_categories=Blogcategory::orderBy('name','asc')->get();
    $title='Blogs';
  	return view('frontend.blogs.blogs',compact('blogs','blog_categories','title'));
  }


// featured blogs

  public function featured_blogs(){
  	$blogs= Blog::latest()->with('blogcategory','bloguser')->where('featured',true)->paginate(12);
  	$blog_categories=Blogcategory::orderBy('name','asc')->get();
    $title='Featured Blogs';
  	return view('frontend.blogs.blogs',compact('blogs','blog_categories','title'));
  }

// featured blogs



  //blog detail
  public function blog_detail($slug){
  	$blog= Blog::where('slug', $slug)->with('blogcategory','bloguser')->firstOrFail();
    $blog->update([
      'views'=>$blog->views+1,
    ]);

    $related_blogs=$this->related_blogs($blog->blogcategory,$blog->id);


  	$blog_categories=Blogcategory::orderBy('name','asc')->get();

    // $response = new Response('Hello World');

    // $response->withCookie(cookie()->forever('category',serialize($blog->blogcategory)));
    setcookie('category', $blog->blogcategory, time()+60*60*24*365);
    // Cookie::queue('category','fuck', 60);
    // $response->withCookie(cookie('recent_blog_category',$blog->blogcategory, 15));

  	return view('frontend.blogs.blog_detail',compact('blog','blog_categories','related_blogs'));

    // return $related_blogs;

  }

// recommended blogs
  public function recommendation(){
    if(isset($_COOKIE['category'])){
      $categories = json_decode($_COOKIE['category']);
      if($categories ){
      $recommended_blogs=$this->related_blogs($categories,-1);
     }
    }else{
      $recommended_blogs=[];
     }
     return  $recommended_blogs;
   }
// recommended blogs



  public function related_blogs($categories,$id){
    
    $blogs=[];
    $blog_categories=Blogcategory::orderBy('name','asc')->with('blogcategory');
    $allblogs= Blog::latest()->with('blogcategory','bloguser')->get();
 
    foreach($categories as $cat){
      $filtered=$this->filter_blog_by_category($allblogs,$cat->id);
        foreach($filtered as $f){
          if($f->id!==$id){
            array_push($blogs,$f);
          }
        }
      }
    

    if(count($blogs)==0){
      $bgs=Blog::latest()->with('blogcategory','bloguser')->get();
      foreach($bgs as $b){
        if($b->id!==$id){
          array_push($blogs,$b);
        }
      }
    }

    $blogs=array_unique($blogs);
    
    shuffle($blogs);


    $related=[];

    if(count($blogs)>4){
      for($i=0;$i<4;$i++){
        array_push($related,$blogs[$i]);
      }
    }else{
      $related=$blogs;
    }
    

    shuffle($related);
    

    return  $related;
  }


  //blog by category function
  public function blogs_by_category($slug){
 		$blog_cat=Blogcategory::latest()->where('slug', $slug)->with('blogcategory')->first();
 		$allblogs= Blog::latest()->with('blogcategory','bloguser')->get();
 		
 		//filtercategory
 		$blogs=$this->filter_blog_by_category($allblogs,$blog_cat->id);

 		$blogs=$this->paginate($blogs, $perPage = 12, $page = null, $options = ['path'=>route('blogs.by_category',['slug' => $slug])]);
 		//filtercategory

    $title='Blogs - '. $blog_cat->name;

  	$blog_categories=Blogcategory::orderBy('name','asc')->get();
  	return view('frontend.blogs.blog_category',compact('blogs','blog_categories','title'));
  }
  //blog by category function



	//category filter
  public function filter_blog_by_category($blogs,$category_id){
  	$filtered_blogs=[];
  	$filtered_blogs_count=0;

  	foreach($blogs as $b){

  		$blog_categories=$b->blogcategory;//blog category
  		$blog_cat_ids=[];

  		for($i=0;$i<count($blog_categories);$i++){
  			$blog_cat_ids[$i]=$blog_categories[$i]->id;
  		}

  		if(in_array($category_id, $blog_cat_ids)){
  			$filtered_blogs[$filtered_blogs_count]=$b;
  			$filtered_blogs_count++;
  		}
  	}

  	return $filtered_blogs;
  }
  //category filter


  // array pagination function
    public function paginate($items, $perPage = 2, $page = null, $options = [])
    {
      $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
      $items = $items instanceof Collection ? $items : Collection::make($items);
      return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
  // array pagination function
}
