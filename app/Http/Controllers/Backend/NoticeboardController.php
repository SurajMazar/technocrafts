<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\crudNoticeboard;
use App\Noticeboard;
use App\User;
class NoticeboardController extends Controller
{
    public function index(){
    	return view('admin.noticeboard.index');
    }

    // create notice
    public function create(crudNoticeboard $request){
    	return $request->createNotice();
    }
    // end create notice



    // get notices
    public function getNotices(){

    	$notices =  Noticeboard::latest()->with('user')->paginate(10);

    	return $notices;
    }
    // end notices



    // show notice
    public function show($id){
    	return Noticeboard::findOrFail($id);
    }
    // end show notice



    // update notice
    public function update(crudNoticeboard $request,$id){
    	return $request->updateNotice($id);
    }
    // end update notice


    // delete notice
    public function delete($id){
	    $notice=Noticeboard::findOrFail($id);
	    $this->deleteImage($notice->image);
	    $notice->delete();
	  }
	  // end delete notice


	  public function deleteImage($imageName){
	    $currentImageFile=public_path('images/notice/').$imageName;
	    if(file_exists($currentImageFile)){
	      @unlink($currentImageFile);
	    }
	  }

}
