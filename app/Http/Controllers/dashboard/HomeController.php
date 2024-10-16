<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Venue;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){

        $venues = Venue::all(); 
        return view('home', compact('venues')); 
        
    }

    public function dashboard()
    {
        return view('dashboard.index');
    }

}
