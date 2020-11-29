<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;

class Brandcontroller extends Controller
{



    public function __construct()
    {
      $this->middleware('auth');//authentication middle ware
  	}



  	//brand with pagination
  	public function brandWithPagination(){
  		return Brand::latest()->with('laptopbrand')->paginate(10);
  	}
  	//brand with pagination end




  	//brand without pagination
  	public function brandNoPagination(){
  		return Brand::latest()->with('laptopbrand')->get();
  	}
  	//brand without pagination end




  	// create brand function
  	public function create(Request $request){

  		//validation
  		$this->validate($request,[
  			'name'=> 'required',
  			'slug'=> 'required|unique:brands',
  		]);

  		//brand image
  		if($request->brand_image){
  			$imageName=time().'.'.explode('/',explode(':',substr($request->brand_image,0,strpos($request->brand_image,';')))[1])[1];
	  		\Image::make($request->brand_image)->save(public_path('images/brands/').$imageName);
	  		$request->merge(['brand_image'=>$imageName]);

  		}else{
  			$request->merge(['brand_image'=>'no-brand-image.jpg']);
  		}
  		//end brand image

  		if($request['meta_title']==''){
	      $request['meta_title']=$request['name'];
	    }

	    if($request['meta_keyword']==''){
	      $request['meta_keyword']=$request['name'];
	    }

	    if($request['meta_description']==''){
	      $request['meta_description']=$request['name'];
	    }

  		//create
  		Brand::create([
  			'name'=>$request['name'],
  			'slug'=>$request['slug'],
  			'brand_image'=>$request['brand_image'],
  			'description'=>$request['description'],
  			'meta_title'=>$request['meta_title'],
  			'meta_keyword'=>$request['meta_keyword'],
  			'meta_description'=>$request['meta_description'],
  		]);
  	}

  	// create brand function end




  	// brand show as per id
  	public function show($id){
  		$brand=Brand::latest();
  		return $brand->findOrFail($id);
  	}
  	// end brand show as per id




  	//update brand
  	public function update(Request $request,$id){

  		$brand=Brand::findOrFail($id);

  		//validation
  		if(strtolower($request->name)!=strtolower($brand->name)){
  			$this->validate($request,[
  				'name'=> 'required',
  				'slug'=> 'required|unique:brands',
  			]);
  		}
  		// end validation

  		// image update

  		$currentBrandImage=$brand->brand_image;// current image name from the database

	  		if($request->brand_image){

	  			if($currentBrandImage!=$request->brand_image){

	  				$imageName=time().'.'.explode('/',explode(':',substr($request->brand_image,0,strpos($request->brand_image,';')))[1])[1];
			  		\Image::make($request->brand_image)->save(public_path('images/brands/').$imageName);
			  		$request->merge(['brand_image'=>$imageName]);

			  		$currentBrandImageFile=public_path('images/brands/').$currentBrandImage;

			  		if(file_exists($currentBrandImageFile)){
			  			@unlink($currentBrandImageFile);
			  		}

	  			}
	  			
	  		}else{
	  			$request->merge(['brand_image'=>'no-brand-image.jpg']);
	  		}
  		// end image update

	  	// eloquent update
	  		$brand->update([
  			'name'=>$request['name'],
  			'slug'=>$request['slug'],
  			'brand_image'=>$request['brand_image'],
  			'description'=>$request['description'],
  			'meta_title'=>$request['meta_title'],
  			'meta_keyword'=>$request['meta_keyword'],
  			'meta_description'=>$request['meta_description'],
  		]);
	  	// end eloquent update

  	}
  	// end update brand



  	// trash function
  	public function trash($id){
  		$brand=Brand::findOrFail($id);
  		return $brand->delete();
  	}
  	// end trash function



  	//trashed brands
  	public function trashed_brands(){
  		return Brand::onlyTrashed()->paginate(10);
  	}
  	//trashed brands


  	// restore function
  	public function restore($id){
  		$brand = Brand::onlyTrashed();
  		$brand=$brand->findOrFail($id);
  		$brand->restore();
  	}
  	// end restore function



}
