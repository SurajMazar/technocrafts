<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subscriber;

class SubscriberController extends Controller
{
	// subscriber page
   public function index(){
   	return view('admin.subscribers.index');
   }
   //end subscriber page

   // paginated subscriber
   public function paginated(){
   	return Subscriber::latest()->paginate(10);
   }
   // end paginated subscriber

   // delete
   public function delete($id){
   	$subscriber = Subscriber::findOrFail($id);
   	return $subscriber->delete();
   }
   // end delete
}
