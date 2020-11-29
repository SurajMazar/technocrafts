<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use App\Laptop;

class LaptopController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');//authentication middle ware
	}

	public function index(){
		return Laptop::latest()->with('laptopbrand')->paginate(10);
	}

	// laptop creation function
	public function create(Request $request){
		// validation
		$this->validate($request,[
      'name'          =>   'required',
      'slug'					=>   'required|unique:laptops',
      'dimension'     =>   'required',
      'weight'        =>   'required',
      'price'         =>   'required',
      'cpu'           =>   'required',
      'gui'           =>   'required',
      'hdd'           =>   'required',
      'RAM'           =>   'required',
      'display'       =>   'required',
      'diagonal'      =>   'required',
      'battery'      =>   'required',
      'resolution'    =>   'required',
      'pixel_density' =>   'required',
      'brand'         =>   'required'
    ]);
		// end validation

		 $laptop_name=str_replace(' ','_',$request->name);
      $laptop_name=str_replace('/','', $laptop_name);
      // features
      $this->return_yes_no($request,'webcamera');
      $this->return_yes_no($request,'microphone');
      $this->return_yes_no($request,'backlit_keyboard');
      $this->return_yes_no($request,'speakers');
      $this->return_yes_no($request,'optical_drive');
      $this->return_yes_no($request,'security_lock');
      $this->return_yes_no($request,'finger_print');

      // ports
      $this->return_yes_no($request,'hdmi');
      $this->return_yes_no($request,'vga');
      $this->return_yes_no($request,'dvi');
      $this->return_yes_no($request,'ethernet');
      $this->check_port_features($request,'usb');
      $this->check_port_features($request,'card_reader');
      $this->check_port_features($request,'wifi');
      $this->check_port_features($request,'bluetooth');
      $this->check_port_features($request,'audiojack');

      // os
      $this->check_port_features($request,'os');

      //feature image
      if($featured_image=$request->featured_image){
        $path = public_path().'/images/laptops/'.$laptop_name.'/';
         if ( ! File::exists($path) ) {
          File::makeDirectory($path, $mode = 0777, true, true);
        }
         $imageName=time().'.'.explode('/',explode(':',substr($request->featured_image,0,strpos($request->featured_image, ';')))[1])[1];
       \Image::make($request->featured_image)->save(public_path('images/laptops/'. $laptop_name.'/').$imageName);     
        $request->merge(['featured_image'=> $imageName]);
      }else{
        $request->merge(['featured_image'=> 'no-laptop-image.jpg']);
      }


      // related image
      if($related_images=$request->related_images){
        $no_of_images=count($related_images);
        for($i=0 ;$i<$no_of_images; $i++){
          $image=$related_images[$i];
          $relatedImageName='related'.$i.time().'.'.explode('/',explode(':',substr($image,0,strpos($image, ';')))[1])[1];
          \Image::make($image)->save(public_path('images/laptops/'. $laptop_name.'/').$relatedImageName);
          $allrelatedImages[$i]=$relatedImageName;
        }

        $request->merge(['related_images'=>serialize($allrelatedImages)]); //unserialize($str);
      }else{
        $request->merge(['related_images'=> 'no-laptop-image.jpg']);
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
     
     	// create function
      $laptop=Laptop::create([
        'name'=>$request['name'],
        'dimension'=>$request['dimension'],
        'slug'=>$request['slug'],
        'battery'=>$request['battery'],
        'weight'=>$request['weight'],
        'price'=>$request['price'],
        'cpu'=>$request['cpu'],
        'gui'=>$request['gui'],
        'hdd'=>$request['hdd'],
        'RAM'=>$request['RAM'],
        'os'=>$request['os'],
        'usb'=>$request['usb'],
        'hdmi'=>$request['hdmi'],
        'vga'=>$request['vga'],
        'dvi'=>$request['dvi'],
        'ethernet'=>$request['ethernet'],
        'card_reader'=>$request['card_reader'],
        'wifi'=>$request['wifi'],
        'bluetooth'=>$request['bluetooth'],
        'audiojack'=>$request['audiojack'],
        'webcamera'=>$request['webcamera'],
        'webcamera_name'=>$request['webcamera_name'],
        'backlit_keyboard'=>$request['backlit_keyboard'],
        'microphone'=>$request['microphone'],
        'speakers'=>$request['speakers'],
        'speaker_name'=>$request['speaker_name'],
        'optical_drive'=>$request['optical_drive'],
        'security_lock'=>$request['security_lock'],
        'security_lock_name'=>$request['security_lock_name'],
        'finger_print'=>$request['finger_print'],
        'display'=>$request['display'],
        'diagonal'=>$request['diagonal'],
        'resolution'=>$request['resolution'],
        'pixel_density'=>$request['pixel_density'],
        'featured_image'=>$request['featured_image'],
        'related_images'=>$request['related_images'],
        'meta_title'=>$request['meta_title'],
        'meta_description'=>$request['meta_description'],
        'meta_keyword'=>$request['meta_keyword'],
      ]);

      if($request->brand){
        $laptop->laptopbrand()->sync($request->brand);
      }
	}

		//creating laptop functions
		public function return_yes_no($request,$content){
	    if($request->$content){
	      $request->merge([$content=>'yes']);
	    }
	    else{
	      $request->merge([$content=>'no']);
	    }

	    return $request->$content;
	  }

	  public function check_port_features($request,$content){
	    if($request->$content==''){
	      $request->merge([$content=>'no']);
	    }
	    return $request->$content;
	  }

	  //end creating laptop functions

  // end create function


	 // laptop edit page
	  public function edit($id){
	  	$laptop=Laptop::latest()->with('laptopbrand');
	  	$laptop=$laptop->findOrFail($id);
	  	if($laptop->related_images!='no-laptop-image.jpg'){
        $laptop->related_images=unserialize($laptop->related_images);
      }
	  	return view('admin.gadgets.laptop.editlaptop',compact('laptop'));
	  }
	 // laptop edit page end


	  // laptop update
	  public function update(Request $request,$id){
	  	$laptop= Laptop::findOrfail($id);
        $this->validate($request,[
	        'name'          =>   'required',
		      'dimension'     =>   'required',
		      'slug'					=>   'required',
		      'weight'        =>   'required',
		      'price'         =>   'required',
		      'cpu'           =>   'required',
		      'gui'           =>   'required',
		      'hdd'           =>   'required',
		      'RAM'           =>   'required',
		      'display'       =>   'required',
		      'diagonal'      =>   'required',
		      'battery'      =>   'required',
		      'resolution'    =>   'required',
		      'pixel_density' =>   'required',
		      'brand'         =>   'required'
	      ]);

      $laptop_name=str_replace(' ','_',$request->name);
      $laptop_name=str_replace('/','', $laptop_name);

      // features
      $this->return_yes_no($request,'webcamera');
      $this->return_yes_no($request,'microphone');
      $this->return_yes_no($request,'backlit_keyboard');
      $this->return_yes_no($request,'speakers');
      $this->return_yes_no($request,'optical_drive');
      $this->return_yes_no($request,'security_lock');
      $this->return_yes_no($request,'finger_print');

      // ports
      $this->return_yes_no($request,'hdmi');
      $this->return_yes_no($request,'vga');
      $this->return_yes_no($request,'dvi');
      $this->return_yes_no($request,'ethernet');
      $this->check_port_features($request,'usb');
      $this->check_port_features($request,'card_reader');
      $this->check_port_features($request,'wifi');
      $this->check_port_features($request,'bluetooth');
      $this->check_port_features($request,'audiojack');

      // os
      $this->check_port_features($request,'os');

      $current_laptop_name=str_replace(' ','_',$laptop->name);


      if($current_laptop_name!=$laptop_name){
        $old_folder=public_path('/images/laptops/'.$current_laptop_name.'/');
        $new_folder=public_path().'/images/laptops/'.$laptop_name.'/';
        if( ! File::exists($new_folder)){
          File::makeDirectory($new_folder,$mode = 0777, true, true);
          File::moveDirectory($old_folder,$new_folder,true);
          File::deleteDirectory($old_folder,true);
        }
      }
      //featured image update
      $current_feature_image=$laptop->featured_image;

      if($request->featured_image){
        if($request->featured_image!=$current_feature_image){
          $imageName=time().'.'.explode('/',explode(':',substr($request->featured_image,0,strpos($request->featured_image, ';')))[1])[1];
          \Image::make($request->featured_image)->save(public_path('/images/laptops/'. $laptop_name.'/').$imageName);     
          $request->merge(['featured_image'=> $imageName]);
          $feature_image=public_path('/images/laptops/'.$laptop_name.'/'). $current_feature_image;
          if(file_exists($feature_image)){
            if($current_feature_image!='no-laptop-image.jpg'){
              @unlink($feature_image);
            }
          }
        }
      }else{
        $request->merge(['featured_image'=>'no-laptop-image.jpg']);
        $feature_image=public_path('images/laptops/'.$laptop_name.'/'). $current_feature_image;
          if(file_exists($feature_image)){
            if($current_feature_image!='no-laptop-image.jpg'){
              @unlink($feature_image);
            }
          }
      }

      if($laptop->related_images=='no-laptop-image.jpg'){
        $current_related_images=[];
      }else{
        $current_related_images=unserialize($laptop->related_images);
      }
      

      if($related_images=$request->related_images){
        $no_of_images=count($related_images);
        $new_related_Images=[];
        $saved_related_images=[];
        for($i=0 ;$i<$no_of_images; $i++){
          $image=$related_images[$i];
          if($this->is_base64_string($image)){
            $relatedImageName='related'.$i.time().'.'.explode('/',explode(':',substr($image,0,strpos($image,';')))[1])[1];
            \Image::make($image)->save(public_path('/images/laptops/'.$laptop_name.'/').$relatedImageName);
            $new_related_Images[]=$relatedImageName;
          }else{
            $saved_related_images[]=$image;
          }
        }
       
        $request->merge(['related_images'=>serialize(array_merge($saved_related_images,$new_related_Images))]);

        $old_related_img_count=count($current_related_images);

        for($i=0 ;$i<$old_related_img_count; $i++){
          $current_related_image_file=public_path('images/laptops/'.$laptop_name.'/').$current_related_images[$i];
          $current_related_image=$current_related_images[$i];
          if(!in_array($current_related_image,array_merge($saved_related_images,$new_related_Images))){
            @unlink($current_related_image_file);
          }
        }

      }else{
        $request->merge(['related_images'=>'no-laptop-image.jpg']);
        if($current_related_images!='no-laptop-image.jpg'){
        $old_related_img_count=count($current_related_images);
        for($i=0 ;$i<$old_related_img_count; $i++){
          $current_related_image_file=public_path('images/laptops/'.$laptop_name.'/').$current_related_images[$i];
          $current_related_image=$current_related_images[$i];
          @unlink($current_related_image_file);
        }
       }
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


      $laptop->update([
        'name'=>$request['name'],
        'dimension'=>$request['dimension'],
        'slug'=>$request['slug'],
        'battery'=>$request['battery'],
        'weight'=>$request['weight'],
        'price'=>$request['price'],
        'cpu'=>$request['cpu'],
        'gui'=>$request['gui'],
        'hdd'=>$request['hdd'],
        'RAM'=>$request['RAM'],
        'os'=>$request['os'],
        'usb'=>$request['usb'],
        'hdmi'=>$request['hdmi'],
        'vga'=>$request['vga'],
        'dvi'=>$request['dvi'],
        'ethernet'=>$request['ethernet'],
        'card_reader'=>$request['card_reader'],
        'wifi'=>$request['wifi'],
        'bluetooth'=>$request['bluetooth'],
        'audiojack'=>$request['audiojack'],
        'webcamera'=>$request['webcamera'],
        'webcamera_name'=>$request['webcamera_name'],
        'backlit_keyboard'=>$request['backlit_keyboard'],
        'microphone'=>$request['microphone'],
        'speakers'=>$request['speakers'],
        'speaker_name'=>$request['speaker_name'],
        'optical_drive'=>$request['optical_drive'],
        'security_lock'=>$request['security_lock'],
        'security_lock_name'=>$request['security_lock_name'],
        'finger_print'=>$request['finger_print'],
        'display'=>$request['display'],
        'diagonal'=>$request['diagonal'],
        'resolution'=>$request['resolution'],
        'pixel_density'=>$request['pixel_density'],
        'featured_image'=>$request['featured_image'],
        'related_images'=>$request['related_images'],
        'meta_title'=>$request['meta_title'],
        'meta_description'=>$request['meta_description'],
        'meta_keyword'=>$request['meta_keyword'],
      ]);

      if($request->brand){
        $laptop->laptopbrand()->sync($request->brand);
      }
	  }
	  // laptop end update

	  public function is_base64_string($string)  //check base 64 encode 
    {
      // Check if there is no invalid character in string
      if (!preg_match('/^(?:[data]{4}:(text|image|application)\/[a-z]*)/', $string)){
        return false;
      }else{
        return true;
      }

    }



    // trash 
    public function trash($id){
    	$laptop=Laptop::findOrFail($id);
    	$laptop->delete();
    }
    //end trash



    //trashed laptops
    public function trashedLaptop(){
    	$trashedLaptops=Laptop::onlyTrashed();
	    $trashedLaptops=$trashedLaptops->with('laptopbrand')->paginate(10);
	    return $trashedLaptops;
    }
    // end trashed laptops



     // restore 
    public function restore($id){
	    $trashedBlog=Laptop::onlyTrashed()->findOrFail($id);
	    $trashedBlog->restore();
    }
    //end restore


}
