<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\crudSmartphone;
use App\Smartphone;

class SmartphoneController extends Controller
{
   public function index(){
   	return view('admin.gadgets.smartphone.index');
   }

   public function add(){
   	return view('admin.gadgets.smartphone.add');
   }


   public function paginated(){
   	 $smartphones =  Smartphone::latest()->with('brand')->paginate(10);

   	 foreach($smartphones as $s){
   	 	$s->images=unserialize($s->images);
   	 }
   	 return $smartphones;
   }


  public function edit($id){
  	$smartphones =  Smartphone::latest()->with('brand');

		$smartphones=$smartphones->findOrFail($id);

		$smartphones->images=unserialize($smartphones->images);

		return view('admin.gadgets.smartphone.edit',compact('smartphones'));

  }



   public function create(crudSmartphone $request){
   	 return $request->createSmartphone();
   }


   public function trash($id){
   	 $smartphone = Smartphone::findOrFail($id);

   	 return $smartphone->delete();
   }

   public function trashed(){
   	 $smartphones = Smartphone::onlyTrashed()->with('brand')->paginate(10);
   	 foreach($smartphones as $s){
   	 	$s->images=unserialize($s->images);
   	 }
   	 return $smartphones;
   }


   public function restore($id){
   	 $smartphone = Smartphone::onlyTrashed()->findOrFail($id);

   	 return $smartphone->restore();
   }
}
