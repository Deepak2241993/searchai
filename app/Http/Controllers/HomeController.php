<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $faqData = Faq::where('status', 1)->get(); 
        return view('frontend.home', compact('faqData'));
    }
    
}
