<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\createUser;
use App\Http\Requests\updateUser;
use App\User;

class UserController extends Controller
{

	// create page
	public function index(){
		return view('admin.users.index');
	}
  // end create page

  // create page
	public function create_page(){
		return view('admin.users.create');
	}
  // end create page


  // create function
	public function create(createUser $request){
		return $request->createUser();
	}
  // end create function

  // create function
	public function paginated(){
		return User::latest()->with('bloguser')->paginate(9);
	}
  // end create function


	// get user by id
  public function show($id){
  	return User::findOrFail($id);
  }
  // end get user by id

  // update user
  public function update(updateUser $request,$id){
  	return $request->update_user($id);
  }
	// end update user

	// update user
  public function profile(){
  	return view('admin.profile.index');
  }
  // end update user
}
