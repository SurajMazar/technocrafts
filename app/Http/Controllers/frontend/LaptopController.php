<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Laptop;
use App\Brand;

class LaptopController extends Controller
{
   
  // laptop page
  public function index(){
  	$laptops=Laptop::latest()->with('laptopbrand')->paginate(12);
  	$brands=Brand::orderBy('name','asc')->with('laptopbrand')->get();
  	$title='All Laptops';
  	$search='';
  	return view('frontend.laptop.laptop',compact('laptops','brands','title','search'));
  }

  //laptop detail page
  public function laptop_detail_page($slug){
  	$laptop= Laptop::latest()->with('laptopbrand')->where('slug', $slug)->firstOrFail();
    if($laptop->related_images!=='no-laptop-image.jpg'){
      $laptop->related_images=unserialize($laptop->related_images);
    }else{
      $laptop->related_images=[];
    }
  	
  	return view('frontend.laptop.laptop_detail',compact('laptop'));
  }

  // laptop per brand
  public function laptop_per_brand($slug){
  	$brand=Brand::latest()->where('slug', $slug)->with('laptopbrand')->firstOrFail();
 		$allLaptops= Laptop::latest()->with('laptopbrand')->get();
 		
 		//filtercategory
 		$laptops=$this->filter_laptop_by_category($allLaptops,$brand->id);

 		$laptops=$this->paginate($laptops, $perPage = 12, $page = null, $options = ['path'=>route('laptop.brands',['slug' => $slug])]);
 		//filtercategory

 		$title='Laptop - '.$brand->name;

  	$brands=Brand::orderBy('name','asc')->with('laptopbrand')->get();
		$search='';
  	return view('frontend.laptop.laptop',compact('laptops','brands','title','search'));
  }


  //category filter
  public function filter_laptop_by_category($laptops,$category_id){
  	$filtered_laptops=[];
  	$filtered_laptops_count=0;

  	foreach($laptops as $laptop){

  		$laptop_categories=$laptop->laptopbrand;//blog category
  		$laptop_cat_ids=[];

  		for($i=0;$i<count($laptop_categories);$i++){
  			$laptop_cat_ids[$i]=$laptop_categories[$i]->id;
  		}

  		if(in_array($category_id, $laptop_cat_ids)){
  			$filtered_laptops[$filtered_laptops_count]=$laptop;
  			$filtered_laptops_count++;
  		}
  	}

  	return $filtered_laptops;
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

  //search laptop
  public function search(Request $request){
  	$laptops=Laptop::where('name', 'LIKE', "%{$request->search}%")->with('laptopbrand')->paginate(12);
  	$brands=Brand::orderBy('name','asc')->get();
  	$title='Search results for - '.$request->search;
  	$search=$request->search;
  	return view('frontend.laptop.laptop',compact('laptops','brands','title','search'));
  }
  //search


  // sort price asc
  public function price_asc(){

    $laptops = Laptop::orderBy('price','asc')->with('laptopbrand')->paginate(12);

    
    $brands=Brand::orderBy('name','asc')->get();

    $title= 'Low to High';

    return view('frontend.laptop.laptop',compact('laptops','brands','title'));

  }


  // sort price dec
  public function price_dec(){

    $laptops = Laptop::orderBy('price','desc')->with('laptopbrand')->paginate(12);

   
    $brands=Brand::orderBy('name','asc')->get();

    $title= 'High to Low';

    return view('frontend.laptop.laptop',compact('laptops','brands','title'));

  }


  // sort alpha dec
  public function alpha_dec(){

    $laptops = Laptop::orderBy('name','desc')->with('laptopbrand')->paginate(12);

  
    $brands=Brand::orderBy('name','asc')->get();

    $title= 'Alphabetical(Z-A)';

    return view('frontend.laptop.laptop',compact('laptops','brands','title'));

  }

    // sort alpha asc
  public function alpha_asc(){

    $laptops = Laptop::orderBy('name','asc')->with('laptopbrand')->paginate(12);

    $brands=Brand::orderBy('name','asc')->get();

    $title= 'Alphabetical(A-Z)';

    return view('frontend.laptop.laptop',compact('laptops','brands','title'));

  }
}
