<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Download;
use App\Models\Event;
use App\Models\Album;
use App\Models\MemberCategory;

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

     public function advisory_board(){
        return view('frontend.advisory_board');

   }

   public function become_member(){
       // Fetch categories if needed for membership tiers
       $categories = MemberCategory::all();
       return view('frontend.become_member', compact('categories'));
   }

   public function downloads(){
       // Fetch downloads
       $downloads = Download::latest()->get();
       return view('frontend.downloads', compact('downloads'));
   }

   public function events(){
       // Fetch active events
       $events = Event::where('status', 'Active')->orderBy('event_date', 'asc')->get();
       return view('frontend.events', compact('events'));
   }

   public function gallery(){
       // Fetch albums with their images
       $albums = Album::with('images')->latest()->get();
       return view('frontend.gallery', compact('albums'));
   }

}
