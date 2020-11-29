<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use App\User;

class createUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name'     =>  'required|string|max:255',
          'email'    =>  'required|string|email|max:255|unique:users',
          'password' =>  'required|string|min:8|confirmed',
          'contact'  =>  'required',
          'gender'   =>  'required',
          'role'     =>  'required',
          'address'  =>  'required',
        ];
    }


    public function createUser(){

      $imageName=$this->makeStoreImage($this->image,$this->gender);

      User::create([
        'name'     =>  $this->name,
        'email'    =>  $this->email,
        'image'    =>  $imageName,
        'password' =>  Hash::make($this->password),
        'contact'  =>  $this->contact,
        'gender'   =>  $this->gender,
        'role'     =>  $this->role,
        'address'  =>  $this->address,
      ]);

      // return $image;


    }


    public function makeStoreImage($image,$gender){
      if($image){
        $imageName=time().'.'.explode('/',explode(':',substr($image,0,strpos($image, ';')))[1])[1];
        $imageExt=explode('.',$imageName);// extract the image extension

        preg_match("/data:image\/(.*?);/",$image,$imageExt[1]); 
        $image = preg_replace('/data:image\/(.*?);base64,/','',$image); // remove the type part
        $image = str_replace(' ', '+', $image);

        \File::put(public_path('/images/users/') . $imageName, base64_decode($image));
      }else{
        $imageName='no-'.strtolower($gender).'-image.jpg';
      }

      return '/images/users/'.$imageName;
    }

}
