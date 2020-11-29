<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Blog;
use App\Subscriber;

use App\Mail\notifysubscriber;
use Illuminate\Support\Facades\Mail; 
class BlogController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(){
  	return view('admin.blogs.blogs');
  }

  public function blogswithpagination(){
  	return Blog::latest()->with('blogcategory','bloguser')->paginate(10);
  }

  public function createpage(){
  	return view('admin.blogs.createblog');
  }


  public function create(Request $request){
  	$this->validate($request,[
  		'title'=>'required',
  		'slug'=>'required',
  	]);


  	if($request->featured_image){
  		$imageName=time().'.'.explode('/',explode(':',substr($request->featured_image,0,strpos($request->featured_image, ';')))[1])[1];
  		\Image::make($request->featured_image)->save(public_path('images/blogs/').$imageName);
  		$request->merge(['featured_image'=>$imageName]);
  	}else{
  		$request->merge(['featured_image'=>'no-image.jpg']);
  	}

    if($request['meta_title']==''){
      $request['meta_title']=$request['title'];
    }
    if($request['meta_keyword']==''){
      $request['meta_keyword']=$request['title'];
    }
    if($request['meta_description']==''){
      $request['meta_description']=$request['title'];
    }
    

  	$blog=Blog::create([
  		'title'=>$request['title'],
  		'excerpt'=>$request['excerpt'],
  		'slug'=>$request['slug'],
  		'featured_image'=>$request['featured_image'],
  		'description'=>$request['description'],
      'views'=>0,
  		'meta_title'=>$request['meta_title'],
  		'meta_keyword'=>$request['meta_keyword'],
  		'meta_description'=>$request['meta_description'],
      'featured'=>$request['featured']
  	]);

  	if($request->category_id){
  		$blog->blogcategory()->sync($request->category_id);
  	}
    if($request->user_id){
      $blog->bloguser()->sync($request->user_id);
    }

    if($request['notify_subscriber']){
      $suscribers = Subscriber::all();
      foreach($suscribers as $s){
        Mail::to($s->email)->send(new notifysubscriber($blog));
      }
    }


  }

  public function edit_page($id){
     $blog= Blog::latest()->with('blogcategory');
    $blog= $blog->findOrFail($id);
    return view('admin.blogs.editblog',compact('blog'));
  }



  public function update(Request $request,$id){
    $current_blog=Blog::findOrFail($id);
    if($request->title!=$current_blog->title){
      $this->validate($request,[
        'title'=>'required',
        'slug'=>'required',
      ]);
    }

    $current_blog_image=$current_blog->featured_image;
    if($request->featured_image){
      if($current_blog_image!=$request->featured_image){
        $imageName=time().'.'.explode('/',explode(':',substr($request->featured_image,0,strpos($request->featured_image, ';')))[1])[1];
        \Image::make($request->featured_image)->save(public_path('images/blogs/').$imageName);
        $request->merge(['featured_image'=>$imageName]);
        $current_image=public_path('images/blogs/').$current_blog_image;

        if(file_exists($current_image)){
          @unlink($current_image);
        }
      }
    }else{
      $request->merge(['featured_image'=>'no-image.jpg']);
    }

     $current_blog->update([
      'title'=>$request['title'],
      'excerpt'=>$request['excerpt'],
      'slug'=>$request['slug'],
      'featured_image'=>$request['featured_image'],
      'description'=>$request['description'],
      'meta_title'=>$request['meta_title'],
      'meta_keyword'=>$request['meta_keyword'],
      'meta_description'=>$request['meta_description'],
      'featured'=>$request['featured']
    ]);

    if($request->category_id){
      $current_blog->blogcategory()->sync($request->category_id);
    }else{
       $current_blog->blogcategory()->detach();
    }

    if($request['notify_subscriber']){
      $suscribers = Subscriber::all();
      $cblog= Blog::findOrFail($id);
      foreach($suscribers as $s){
        Mail::to($s->email)->send(new notifysubscriber($cblog));
      }
    }
  }




  public function trashed_blogs(){
    $trashedBlogs=Blog::onlyTrashed();
    $trashedBlogs=$trashedBlogs->with('blogcategory','bloguser')->paginate(10);
    return $trashedBlogs;
  }

  public function trash($id){
    $blog= Blog::findOrFail($id);
    $blog->delete();
  }

  public function restore($id){
    $trashedBlog=Blog::onlyTrashed()->findOrFail($id);
    $trashedBlog->restore();
  }


}
