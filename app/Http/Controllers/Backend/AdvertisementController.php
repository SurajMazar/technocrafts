<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\Advertisement\crudAdvertisement;
use App\Advertisement;

class AdvertisementController extends Controller
{

	public function get_paginated_ads(){//paginated ads
		return Advertisement::latest()->with('adsCategory')->paginate(10);
	}//paginated ads


  // create ads
  public function store(crudAdvertisement $request){
  	return $request->storeAds();
  }
  //end create ads


  public function show($id){//return ads by id
  	$ad= Advertisement::latest()->with('adsCategory');

  	return $ad->findOrFail($id);
  }//return ads by id


  // update ads
  public function update(crudAdvertisement $request,$id){
    return $request->updateAds($id);
  }
  //update ads

  // trash ads
  public function trash($id){
    $ad = Advertisement::findOrFail($id);
    return $ad->delete();
  }
  // end trash ads

  // trashed ads
  public function trashed(){
    $ads = Advertisement::onlyTrashed()->paginate(10);
    return $ads;
  }
  // end trashed ads

  // restore trashed ads
  public function restore($id){
    $ads = Advertisement::onlyTrashed();
    $ad = $ads->findOrFail($id);
    return $ad->restore();
  }
  // end restore trashed ads


}
