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

    public function activites_services(){
        return view('frontend.activites_services');
    }
   public function  registartion_certificate(){
            return view('frontend.registartion_certificate');

   }
 public function  awards_recognition(){
            return view('frontend.awards_recognition');

   }

    public function  annual_reports(){
            return view('frontend.annual_reports');

   }


    public function  executive_committee(){
            return view('frontend.executive_committee');

   }

    public function  special_invitees(){
            return view('frontend.special_invitees');

   }

   public function sub_committees(){
                return view('frontend.sub_committees');

   }

   
}
