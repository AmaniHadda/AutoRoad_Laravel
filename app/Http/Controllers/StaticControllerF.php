<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticControllerF extends Controller
{
    public function home () {
        return view('FrontOffice.home');
    }
    public function blog () {
        return view('FrontOffice.blog');
    }
    public function about () {
        return view('FrontOffice.about');
    }
    public function pricing () {
        return view('FrontOffice.pricing');
    }
    public function car () {
        return view('FrontOffice.car');
    }
    public function contact () {
        return view('FrontOffice.chat');
    }
}
