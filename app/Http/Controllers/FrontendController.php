<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //


    public function index(){
        return view('frontend.index');
    }
    public function login(){
        return view('auth.login');
    }


    public function profile(){
        return view('frontend.profile');
    }

     public function aim_objective(){
        return view('frontend.aim_objective');
    }

    public function interest_group(){
        return view('frontend.interest_group'); 
    }
}
