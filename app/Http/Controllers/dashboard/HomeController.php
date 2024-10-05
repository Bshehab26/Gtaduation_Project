<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }

    public function dashboard()
    {
        return view('dashboard.index');
    }

}
