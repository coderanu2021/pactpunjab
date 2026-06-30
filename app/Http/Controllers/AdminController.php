<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard(){
        // Fetch actual counts
        $totalMembers = \App\Models\Member::count();
        $pendingApprovals = \App\Models\CertificationRegistration::where('status', 'Pending')->count();
        
        // Certificates issued (Personal + Association)
        $personalCerts = \App\Models\PersonalCertificate::count();
        $assocCerts = \App\Models\AssociationCertificate::count();
        $totalCertificates = $personalCerts + $assocCerts;
        
        $upcomingEvents = \App\Models\Event::where('status', 'Active')->count();
        
        $totalRegistrations = \App\Models\CertificationRegistration::count();
        $totalAlbums = \App\Models\Album::count();
        $unreadNotifications = \App\Models\Notification::count(); // Assuming all or add a condition if unread exists
        $totalDocuments = \App\Models\Download::count() + \App\Models\Report::count();
        $totalPages = 10; // Number of CMS pages
        
        return view('admin.dashboard.index', compact(
            'totalMembers', 'pendingApprovals', 'totalCertificates', 'upcomingEvents',
            'totalRegistrations', 'totalAlbums', 'unreadNotifications', 'totalDocuments', 'totalPages'
        ));
    }
}
