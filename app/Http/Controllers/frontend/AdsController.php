<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Advertisement;
use App\Advertisementcategory;

class AdsController extends Controller
{
    //get ads by cat
    public function adsByCat($slug){
        $adCat = Advertisementcategory::latest()->with('adsCategory');
        $adCat = $adCat->where('slug',$slug)->first();
        $validAds=[];
        if($adCat){
            foreach($adCat->adsCategory as $ads){
            if($this->validateAds($ads->start_date, $ads->end_date)){
                    array_push($validAds,$ads);
                }
            }
        }

        return  $validAds;
    }       
    //end get ads by cat


    public function validateAds($startDate,$endDate){
        $currentDate=strtotime(date("Y-m-d"));
        $startDate=strtotime($startDate);
        $endDate=strtotime($endDate);
        if($startDate){
            if($currentDate < $startDate){
                return false;
            }
        }

        if($endDate){
            if($currentDate > $endDate){
                return false;
            }
        }

        if($startDate && $endDate){
            if(($currentDate < $startDate) || ($currentDate > $endDate)){
                return false;
            }
        }

        return true;
    }
}
