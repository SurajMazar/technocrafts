<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Smartphone;
use App\Smbrand;

class SmartphoneController extends Controller
{
	// smartphone page
	public function index(){

		$smartphones = Smartphone::latest()->with('brand')->paginate(12);

		foreach($smartphones as $s){
   	 	$s->images=unserialize($s->images);
   	 }

 	 	$brands=Smbrand::orderBy('name','asc')->get();

		return view('frontend.smartphone.index',compact('smartphones','brands'));

	}
	//end smartphone page

	public function detail($id){

		$smartphones = Smartphone::latest()->with('brand');

		$smartphone = $smartphones->findOrFail($id);

 	 	$smartphone->images=unserialize($smartphone->images);
   	 
		return view('frontend.smartphone.detail',compact('smartphone'));

	}


	// sort by brand
	public function SortByBrand($id){
		$smartphones = Smartphone::latest()->with('brand')->where('smbrand_id',$id)->paginate(12);

		foreach($smartphones as $s){
   	 	$s->images=unserialize($s->images);
   	 }


 		$brands=Smbrand::orderBy('name','asc')->get();

 		$brand=Smbrand::findOrFail($id);
 		$title= $brand->name;

		return view('frontend.smartphone.index',compact('smartphones','brands','title'));
	}


	// sort price asc
	public function price_asc(){

		$smartphones = Smartphone::orderBy('price','asc')->with('brand')->paginate(12);

		foreach($smartphones as $s){
   	 	$s->images=unserialize($s->images);
   	 }

 	 	$brands=Smbrand::orderBy('name','asc')->get();

 		$title= 'Low to High';

		return view('frontend.smartphone.index',compact('smartphones','brands','title'));

	}


	// sort price dec
	public function price_dec(){

		$smartphones = Smartphone::orderBy('price','desc')->with('brand')->paginate(12);

		foreach($smartphones as $s){
   	 	$s->images=unserialize($s->images);
   	 }

 	 	$brands=Smbrand::orderBy('name','asc')->get();

 		$title= 'High to Low';

		return view('frontend.smartphone.index',compact('smartphones','brands','title'));

	}


	// sort alpha dec
	public function alpha_dec(){

		$smartphones = Smartphone::orderBy('name','desc')->with('brand')->paginate(12);

		foreach($smartphones as $s){
   	 	$s->images=unserialize($s->images);
   	 }

 	 	$brands=Smbrand::orderBy('name','asc')->get();

 		$title= 'Alphabetical(Z-A)';

		return view('frontend.smartphone.index',compact('smartphones','brands','title'));

	}

		// sort alpha asc
	public function alpha_asc(){

		$smartphones = Smartphone::orderBy('name','asc')->with('brand')->paginate(12);

		foreach($smartphones as $s){
   	 	$s->images=unserialize($s->images);
   	 }

 	 	$brands=Smbrand::orderBy('name','asc')->get();

 		$title= 'Alphabetical(A-Z)';

		return view('frontend.smartphone.index',compact('smartphones','brands','title'));

	}


	public function search(Request $request){

		$smartphones = Smartphone::latest()->where('name', 'LIKE', "%{$request->search}%")->with('brand')->paginate(12);

		foreach($smartphones as $s){
   	 	$s->images=unserialize($s->images);
   	 }

 	 	$brands=Smbrand::orderBy('name','asc')->get();

 		$search=$request->search;

		return view('frontend.smartphone.index',compact('smartphones','brands','search'));

	}

}
