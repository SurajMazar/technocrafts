<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Noticeboard;

class crudNoticeboard extends FormRequest
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
            'title'=>'required | max:150',
        ];
    }

    public function createNotice(){

      $image = $this->makeStoreImage($this->image);

      $notice=Noticeboard::create([
        'title'=>$this->title,
        'image'=>$image,
        'user_id'=>$this->user_id,
        'description'=>$this->description
      ]);

      // $notice->user()->sync($this->user_id);

    }


  public function makeStoreImage($image){

    if($image){
      $imageName=time().'.'.explode('/',explode(':',substr($image,0,strpos($image, ';')))[1])[1];
      $imageExt=explode('.',$imageName);// extract the image extension

      preg_match("/data:image\/(.*?);/",$image,$imageExt[1]); 
      $image = preg_replace('/data:image\/(.*?);base64,/','',$image); // remove the type part
      $image = str_replace(' ', '+', $image);

      \File::put(public_path('/images/notice/') . $imageName, base64_decode($image));
    }else{
      $imageName='no-image.jpg';
    }

    return '/images/notice/'.$imageName;

  }



  public function updateNotice($id){

    $notice=Noticeboard::findOrFail($id);

    if($this->image){
      if($this->image!==$notice->image){
        $this->deleteImage($notice->image);
        $image = $this->makeStoreImage($this->image);
      }
      $image=$this->image;
    }else{
      $this->deleteImage($notice->image);
      $image='no-image.jpg';
    }

     $notice->update([
        'title'=>$this->title,
        'image'=>$image,
        'description'=>$this->description
      ]);


  }


  public function deleteImage($imageName){
    $currentImageFile=public_path('/images/notice/').$imageName;
    if(file_exists($currentImageFile)){
      @unlink($currentImageFile);
    }
  }




}
