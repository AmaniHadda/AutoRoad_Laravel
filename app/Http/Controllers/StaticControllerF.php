<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\risque;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\Trajet;
use Illuminate\Pagination\Paginator;
class StaticControllerF extends Controller
{
    public function home() {
        $listTrajets = Trajet::paginate(3);
        $listBlogs=Blog::paginate(3);
        return view('FrontOffice.home', ['listvehicules' => Vehicle::paginate(4), 'listTrajets' => $listTrajets, 'listBlogs'=>$listBlogs]);
    }
    
    public function blog () {
        return view('FrontOffice.blog');
    }
    public function about () {
        return view('FrontOffice.about');
    }
    public function event () {
        return view('FrontOffice.event');}
    public function pricing () {
        return view('FrontOffice.pricing',['listvehicules'=>Vehicle::all()]);
    }
    public function car () {
        return view('FrontOffice.car');
    }
    public function ajoutContact () {
        $risques=risque::all();
        return view('FrontOffice.ajoutContact',compact('risques'));
    }
    public function rides()
    {
        $listTrajets = Trajet::paginate(3);
    
        return view('FrontOffice.Trajet.trajets', compact('listTrajets'));
    }
    public function contact () {
        return view('FrontOffice.chat');
    }
}