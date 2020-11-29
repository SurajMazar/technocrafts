<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Smbrand;
class BrandController extends Controller
{
  public function index(){
  	$lbrands=Brand::latest()->with('laptopbrand')->get();
  	$sbrands=Smbrand::latest()->with('smartphones')->get();

  	foreach($sbrands as $s){
  		$s->brand_image=$s->image;	
  	}

  	return view('frontend.brands.brands',compact('lbrands','sbrands'));
  }


  public function detail($id){
  	$brand=Brand::findOrFail($id);

  	return view('frontend.brands.brand_detail',compact('brand'));
  }


  public function sm_detail($id){
  	$brand=Smbrand::findOrFail($id);
  	return view('frontend.brands.smbrand_details',compact('brand'));
  }
}
