<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Advertisementcategory;

class AdvertisementcategoryController extends Controller
{
  public function __construct(){ //middleware authentication
 	  $this->middleware('auth');
  }


  // return ads category with pagination
  public function ads_cat_paginate(){
  	return Advertisementcategory::orderBy('name','asc')->with('adsCategory')->paginate(10);
  }
  //end ads cat with pagination



  // return all ads cats (with out pagination)
  public function ads_cat_all(){
  	return Advertisementcategory::orderBy('name','asc')->with('adsCategory')->get();
  }
  // end return all ads cat (with out pagination)



  // create ads category
  public function create(Request $request){

  	$this->validate($request,[
  		'name'=>'required',
  		'slug'=>'required|unique:advertisementcategories'
  	]);

  	Advertisementcategory::create([
  		'name'        => $request['name'],
  		'slug'        => $request['slug'],
  		'description' => $request['description']
  	]);
  }
  // end create ads category function



  // show cat by id
  public function show($id){
  	$ad_cat=Advertisementcategory::orderBy('name','asc')->with('adsCategory');
  	$ad_cat=$ad_cat->findOrFail($id);
  	return $ad_cat;
  }
  // end show cat by id



  // ads category update
  public function update(Request $request,$id){

		$ads_cat=Advertisementcategory::findOrFail($id);

  	if($ads_cat->name!=$request->name){
	  		$this->validate($request,[
	  		'name'=>'required',
	  		'slug'=>'required|unique:advertisementcategories'
	  	]);
  	}

  	$ads_cat->update([
  		'name'        => $request['name'],
  		'slug'        => $request['slug'],
  		'description' => $request['description']
  	]);

  }
  // end ads cat update function



  // category trash function
  public function trash($id){
  	$ads_cat=Advertisementcategory::findOrFail($id);
  	$ads_cat->delete();
  }
  // end category trash function



  // get trashed categories
  public function trash_category(){
  	$ads_cats=Advertisementcategory::onlyTrashed();
  	$ads_cats=$ads_cats->with('adsCategory')->paginate(10);
  	return $ads_cats;
  }
  // end trashed categories



  // restore trashed category
  public function restore($id){
  	$ads_cat=Advertisementcategory::onlyTrashed();
  	$ads_cat=$ads_cat->findOrFail($id);
  	$ads_cat->restore();
  }
  // restore trashed category end





}
