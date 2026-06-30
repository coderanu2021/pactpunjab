<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Download;
use App\Models\Event;
use App\Models\Album;
use App\Models\MemberCategory;
use App\Models\CommitteeMember;
use App\Models\Service;
use App\Models\Faq;

class FrontendController extends Controller
{
    //


    public function index(){
        $events = Event::where('status', 'Active')->orderBy('event_date', 'asc')->take(4)->get();
        $services = Service::orderBy('sort_order')->take(6)->get();
        $president = CommitteeMember::where('designation', 'President')->first() ?? CommitteeMember::where('type', 'Office Bearer')->first();
        return view('frontend.index', compact('events', 'services', 'president'));
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
        $services = Service::where('category', 'Activity')->orWhere('category', 'Service')->orderBy('sort_order')->get();
        return view('frontend.activites_services', compact('services'));
    }
   public function  registartion_certificate(){
            return view('frontend.registartion_certificate');

   }
 public function  awards_recognition(){
            return view('frontend.awards_recognition');

   }

    public function office_bearers(){
        $members = CommitteeMember::where('type', 'Office Bearer')->orderBy('sort_order')->get();
        return view('frontend.office_bearers', compact('members'));
    }

    public function annual_reports(){
        $reports = \App\Models\Report::where('status', 'Active')->orderBy('created_at', 'desc')->get();
        return view('frontend.annual_reports', compact('reports'));
    }


    public function  executive_committee(){
        $members = CommitteeMember::where('type', 'Executive Committee')->orderBy('sort_order')->get();
        return view('frontend.executive_committee', compact('members'));
    }

    public function  special_invitees(){
        $members = CommitteeMember::where('type', 'Special Invitee')->orderBy('sort_order')->get();
        return view('frontend.special_invitees', compact('members'));
    }

   public function sub_committees(){
        $members = CommitteeMember::where('type', 'Sub Committee')->orderBy('sort_order')->get();
        return view('frontend.sub_committees', compact('members'));
   }

     public function advisory_board(){
        $members = CommitteeMember::where('type', 'Advisory Board')->orderBy('sort_order')->get();
        return view('frontend.advisory_board', compact('members'));
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

    public function advisory_services()
    {
        return view('frontend.advisory_services');
    }

    public function conference_hall()
    {
        return view('frontend.conference_hall');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function grievance()
    {
        $faqs = Faq::where('category', 'Grievance')->orWhere('category', 'General')->orderBy('sort_order')->get();
        return view('frontend.grievance', compact('faqs'));
    }

    public function gst_helpdesk()
    {
        $faqs = Faq::where('category', 'GST')->orWhere('category', 'General')->orderBy('sort_order')->get();
        return view('frontend.gst_helpdesk', compact('faqs'));
    }

    public function media_coverage()
    {
        $coverage = \App\Models\MediaItem::where('type', 'coverage')->orderBy('published_date', 'desc')->get();
        return view('frontend.media_coverage', compact('coverage'));
    }

    public function media_kit()
    {
        return view('frontend.media_kit');
    }

    public function press_release()
    {
        $releases = \App\Models\MediaItem::where('type', 'press_release')->orderBy('published_date', 'desc')->get();
        return view('frontend.press_release', compact('releases'));
    }

}
