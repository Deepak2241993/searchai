<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Banner;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $faqData = Faq::where('status', 1)->get(); 
        $bannerData = Banner::where('status', 1)->get(); 
        $serviceData = Service::where('status', 1)->get(); 
        return view('frontend.home', compact('faqData', 'bannerData', 'serviceData'));
    }

    public function AboutUs(){
        return view('frontend.aboutus');
    }
    
    
}
