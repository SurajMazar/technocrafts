<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Smbrand;
use App\Http\Requests\crudsmartphonebrands;

class SmartphonebrandController extends Controller
{
   public function index(){
   	return view('admin.smartphone_brands.index');
   }


   public function allbrands(){
   	return Smbrand::latest()->with('smartphones')->get(); 
   }

   public function paginated_brands(){
   	return Smbrand::latest()->with('smartphones')->paginate(10); 
   }

   public function create(crudsmartphonebrands $request){
   	return $request->createBrand();
   }


   public function show($id){
   	return Smbrand::findOrFail($id);
   }


  public function update(Request $request,$id){
   	$brand=Smbrand::findOrFail($id);
   	$brandImage=$brand->image;
   		if($request->image){
   			if($brand->image!==$request->image){
   				$image=$this->makeStoreImage($request->image);

   				$currentImageFile=public_path('images/smartphone-brands/').$brandImage;
			    	if($brandImage!='no-image.jpg'){
			    		 @unlink($currentImageFile);
			    	}

   			}else{
   				$image=$brand->image;
   			}
   		}else{

   			$currentImageFile=public_path('images/smartphone-brands/').$brandImage;
		    	if($brandImage!='no-image.jpg'){
		    		 @unlink($currentImageFile);
		    	}

   			$image='no-image.jpg';
   		}


   		 // seo
      if($request['meta_title']==''){
      	$request['meta_title']=$request['name'];
      }
      if($request['meta_description']==''){
      	$request['meta_description']=$request['name'];
      }
      if($request['meta_keyword']==''){
      	$request['meta_keyword']=$request['name'];
      }

   		$brand->update([

   			'name'             => $request->name,
   			'image'            => $image,
   			'description'      => $request->description,
   			'meta_title'       => $request->meta_title,
   			'meta_description' => $request->meta_description,
   			'meta_keyword'     => $request->meta_keyword,

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

  //  public function deleteImage($imageName){
  //   $currentImageFile=public_path('images/smartphone-brands/').$imageName;
  //   	if($imageName!='no-image.jpg'){
  //   		 @unlink($currentImageFile);
  //   	}
  // }

  public function trash($id){
  	$brand=Smbrand::findOrFail($id);
  	$brand->delete();
  }

  public function restore($id){
  	$brand=Smbrand::onlyTrashed()->findOrFail($id);
  	$brand->restore();
  }


  public function trashedBrands(){
  	return Smbrand::onlyTrashed()->paginate(10);
  }


}
