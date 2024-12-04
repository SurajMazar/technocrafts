<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\User;
use App\Noticeboard;
use App\Laptop;
use App\Brand;
use App\Smbrand;
use App\Blog;
use App\Writing;
use App\Smartphone;
use App\BlogCategory;
use App\Mail\notifysubscriber;
use Illuminate\Support\Facades\Mail;
use App\Subscriber;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

      $laptops= Laptop::latest()->paginate(5);//compact
      $smartphones = Smartphone::latest()->paginate(5);//compact

       foreach($smartphones as $s){
          $s->images=unserialize($s->images);
       }

      $allLaptops = Laptop::latest()->get();

      $laptop_count = count($allLaptops);//compact

      $allsmartphones = Smartphone::latest()->get();

      $smartphone_count = count($allsmartphones);//compact

      $laptop_brands = Brand::latest()->get();

      $laptop_brands_count = count($laptop_brands); // compact


      $smartphone_brands_count = count(Smbrand::latest()->get());


      $blogs = Blog::latest()->paginate(5); // compact

      $blog_count = count(Blog::latest()->get());// compact

      $blog_cat_count = count(BlogCategory::latest()->get()); // compact

      $underreview = count(Writing::latest()->where('status' , 'Under review')->get()); // compact

      $author_count= count(User::latest()->where('role','author')->get());

      $users = User::all();

      $subscriber_count = count(Subscriber::all());



      return view('home',compact('laptops' ,'smartphones' ,'laptop_count' ,'smartphone_count', 'laptop_brands_count' ,'smartphone_brands_count' ,'blogs' ,'blog_count', 'blog_cat_count' ,'underreview','author_count','users' , 'subscriber_count'));
    }


    // public function email(){
    //   $blog = Blog::findOrFail(1);
    //   Mail::to('suraj.mazar@gmail.com')->send(new notifysubscriber($blog));
    // return new notifysubscriber($blog);
    // }
}
