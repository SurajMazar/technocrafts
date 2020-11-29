<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use Illuminate\Support\Facades\Hash;


class updateUser extends FormRequest
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
        'email'    =>  'required|string|email|max:255',
        'password' =>  'sometimes|string|min:8|confirmed',
        'contact'  =>  'required',
        'gender'   =>  'required',
        'role'     =>  'required',
        'address'  =>  'required',
      ];
    }


    // update user
    public function update_user($id){

      $user= User::findOrFail($id);

      $currentImage = $user->image;

      if($this->image){ // check image

        if($this->image !== $currentImage){ //same image check

          $image = $this->makeStoreImage($this->image,$this->gender);

          $currentFile = public_path('/images/users/').$currentImage;

          if(file_exists($currentFile)){
            if($currentImage !== '/images/users/no-male-image.jpg'){
              if($currentImage !== '/images/users/no-male-image.jpg'){
                @unlink($currentFile); // delete old image
              }
            }
          }

        }//same image check
        else{
          $image = $currentImage;
        }
      }// check image
      else{
        $image = '/images/users/no-'.strtolower($this->gender).'-image.jpg';
      }


      $user->update([

        'name'     =>  $this->name,
        'email'    =>  $this->email,
        'image'    =>  $image,
        'contact'  =>  $this->contact,
        'gender'   =>  $this->gender,
        'role'     =>  $this->role,
        'address'  =>  $this->address,

      ]);

      if($this->password){
        $user->update([
          'password' =>  Hash::make($this->password),
        ]);
      }

    }

    //update user end



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
