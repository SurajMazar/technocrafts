<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use App\Smartphone;

class crudSmartphone extends FormRequest
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
          "smbrand_id"=>'required',
          "name"=>'required',
          "technology"=>'required',
          "dimension"=>'required',
          "weight"=>'required',
          "sim"=>'required',
          "price"=>'required',
          "battery"=>'required',
          "os"=>'required',
          "chipset"=>'required',
          "cpu"=>'required',
          "gpu"=>'required',
          "ram"=>'required',
          "colors"=>'required',
          "internal_memory"=>'required',
          "display"=>'required',
          "size"=>'required',
          "resolution"=>'required',
          "wlan"=>'required',
          "bluetooth"=>'required',
          "nfc"=>'required',
          "radio"=>'required',
          "usb"=>'required',
        ];
    }



    public function createSmartphone(){
        
      $images=$this->images;

      $allimages=[];
      $slug=Str::slug($this->name);
      $i=0;

      if($this->images)
      foreach($images as $image){
        $title=$slug.'-'.$i.'-';
        $allimages[$i]=$this->makeStoreImages($image,$title);
        $i++;
      }else{
        $allimages=[];
      }

      $allimages=serialize($allimages);

      if($this->meta_title==''){
        $this->meta_title=$this->name;
      }

      if($this->meta_keyword==''){
        $this->meta_keyword=$this->name;
      }

      if($this->meta_description==''){
       $this->meta_description=$this->name;
      }

      Smartphone::create([

        "smbrand_id"=>$this->smbrand_id,
        "name"=>$this->name,
        "technology"=>$this->technology,
        "dimension"=>$this->dimension,
        "weight"=>$this->weight,
        "sim"=>$this->sim,
        "price"=>$this->price,
        "battery"=>$this->battery,
        "os"=>$this->os,
        "chipset"=>$this->chipset,
        "cpu"=>$this->cpu,
        "gpu"=>$this->gpu,
        "ram"=>$this->ram,
        "images"=>$allimages,
        "colors"=>$this->colors,
        "card_reader"=>$this->card_reader,
        "card_reader_description"=>$this->card_reader_description,
        "internal_memory"=>$this->internal_memory,
        "display"=>$this->display,
        "size"=>$this->size,
        "resolution"=>$this->resolution,
        "frontcamera_type"=>$this->frontcamera_type,
        "frontcamera_feature"=>$this->frontcamera_feature,
        "frontcamera_video"=>$this->frontcamera_video,
        "maincamera_type"=>$this->maincamera_type,
        "maincamera_feature"=>$this->maincamera_feature,
        "maincamera_video"=>$this->maincamera_video,
        "loudspeaker"=>$this->loudspeaker,
        "loudspeaker_description"=>$this->loudspeaker_description,
        "headphone_jack"=>$this->headphone_jack,
        "wlan"=>$this->wlan,
        "bluetooth"=>$this->bluetooth,
        "gps"=>$this->gps,
        "gps_description"=>$this->gps_description,
        "nfc"=>$this->nfc,
        "radio"=>$this->radio,
        "usb"=>$this->usb,
        "meta_title"=>$this->meta_title,
        "meta_keyword"=>$this->meta_keyword,
        "meta_description"=>$this->meta_description,

      ]);




    }



    public function makeStoreImages($image,$title){
      if($image){
        $imageName=$title.time().'.'.explode('/',explode(':',substr($image,0,strpos($image, ';')))[1])[1];
        $imageExt=explode('.',$imageName);// extract the image extension

        preg_match("/data:image\/(.*?);/",$image,$imageExt[1]); 
        $image = preg_replace('/data:image\/(.*?);base64,/','',$image); // remove the type part
        $image = str_replace(' ', '+', $image);

        \File::put(public_path('/images/smartphones/') . $imageName, base64_decode($image));
      }else{
        $imageName='no-image.jpg';
      }
      return '/images/smartphones/'.$imageName;
    }
}
