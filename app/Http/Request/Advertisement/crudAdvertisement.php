<?php

namespace App\Http\Request\Advertisement;
use Illuminate\Foundation\Http\FormRequest;
use App\Advertisement;

class crudAdvertisement extends FormRequest{
 
  public function authorize(){
  	return true;
  }

  public function rules(){
  	return [
  		'name'=>'required',
  		'ads_url'=>'required|url',
  	];
  }

	//create store ads
  public function storeAds(){

  	$image=$this->makeStoreImage($this->ads_image);

  	$ads=Advertisement::create([

  		'name'=>$this->name,
  		'ads_url'=>$this->ads_url,
  		'ads_image'=>$image,
  		'start_date'=>$this->start_date,
  		'end_date'=>$this->end_date

  	]);

  	if($this->category_id){
  		$ads->adsCategory()->sync($this->category_id);
  	}

  }//create store ads

  public function makeStoreImage($image){

		if($image){
			$imageName=time().'.'.explode('/',explode(':',substr($image,0,strpos($image, ';')))[1])[1];
			$imageExt=explode('.',$imageName);

			preg_match("/data:image\/(.*?);/",$image,$imageExt[1]); // extract the image extension
			$image = preg_replace('/data:image\/(.*?);base64,/','',$image); // remove the type part
			$image = str_replace(' ', '+', $image);

			\File::put(public_path('/images/advertisement/') . $imageName, base64_decode($image));
		}else{
			$imageName='no-image.jpg';
		}

		return $imageName;

	}

  // update ads
  public function updateAds($id){
    $ads= Advertisement::findOrFail($id);

        if ($this->ads_image) {
            if ($this->ads_image!=$ads->ads_image) {
                $image=$this->makeStoreImage($this->ads_image);
                @unlink(public_path('/images/advertisement/'.$ads->ads_image));
            } else {
                $image=$this->ads_image;
            }
        }else{
					$image='no-image.jpg';
				}

    $ads->update([
      'name'=>$this->name,
      'ads_url'=>$this->ads_url,
      'ads_image'=>$image,
      'start_date'=>$this->start_date,
      'end_date'=>$this->end_date
    ]);

    if($this->category_id){
      $ads->adsCategory()->sync($this->category_id);
    }else{
			$ads->adsCategory()->detach();
		}
  }
  // end update ads

}