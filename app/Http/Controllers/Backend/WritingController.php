<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Writing;

class WritingController extends Controller
{
  public function index(){
  	return view('admin.writing-submission.index');
  }


  public function paginated(){
  	return Writing::latest()->paginate(10);
  }

  public function approve($id){
  	$writing= Writing::findOrFail($id);

  	$writing->update([
  		'status'=>'Approved'
  	]);
  }

  public function reject($id){
  	$writing= Writing::findOrFail($id);

  	$writing->update([
  		'status'=>'Rejected'
  	]);
  }


  public function review($id){
  	$writing= Writing::findOrFail($id);

  	$writing->update([
  		'status'=>'Under review'
  	]);
  }
}
