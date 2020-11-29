<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Smbrand;

class crudsmartphonebrands extends FormRequest
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
          'name'=>'required|max:150',
          'slug'=>'required|unique:smartphonebrands'
        ];
    }

    public function createBrand(){
      $image=$this->makeStoreImage($this->image);

      if($this->meta_title==''){
        $this->meta_title=$this->name;
      }

      if($this->meta_keyword==''){
        $this->meta_keyword=$this->name;
      }

      if($this->meta_description==''){
       $this->meta_description=$this->name;
      }

      Smbrand::create([
        'name'=>$this->name,
        'image'=>$image,
        'name'=>$this->name,
        'slug'=>$this->slug,
        'description'=>$this->description,
        'meta_description'=>$this->meta_description,
        'meta_keyword'=>$this->meta_keyword,
        'meta_title'=>$this->meta_title,
      ]);

    }


    public function makeStoreImage($image){
      if($image){
        $imageName=time().'.'.explode('/',explode(':',substr($image,0,strpos($image, ';')))[1])[1];
        $imageExt=explode('.',$imageName);// extract the image extension

        preg_match("/data:image\/(.*?);/",$image,$imageExt[1]); 
        $image = preg_replace('/data:image\/(.*?);base64,/','',$image); // remove the type part
        $image = str_replace(' ', '+', $image);

        \File::put(public_path('/images/smartphone-brands/') . $imageName, base64_decode($image));
      }else{
        $imageName='no-image.jpg';
      }
      return '/images/smartphone-brands/'.$imageName;
    }
}
