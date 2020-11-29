<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Smbrand;

class GadgetController extends Controller
{
  // gadgets api
  public function brands($gadget){

  	if($gadget=='laptop'){
	  	return Brand::latest()->with('laptopbrand')->get();
  	}else{
	  	return Smbrand::latest()->with('smartphones')->get();
  	}


  }
  //end gadget brand api
}
