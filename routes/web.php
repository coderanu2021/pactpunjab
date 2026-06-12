<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Frontend\CertificationRegistrationController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\CommunicationController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\AuthController;

// ── FRONTEND ROUTES ────────────────────────────────────────────────────────
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/profile', [FrontendController::class, 'profile'])->name('profile');
Route::get('/aim-and-objective', [FrontendController::class, 'aim_objective'])->name('aim-objective');
Route::get('/intrest-group', [FrontendController::class, 'interest_group'])->name('intrest-group');
Route::get('/activities-services', [FrontendController::class, 'activites_services'])->name('activities-services');
Route::get('/registration-certificate', [FrontendController::class, 'registartion_certificate'])->name('registration-certificate');
Route::post('/registration-certificate', [CertificationRegistrationController::class, 'store'])->name('registration-certificate.store');
Route::get('/awards-recognition', [FrontendController::class, 'awards_recognition'])->name('awards-recognition');
Route::get('/annual-reports', [FrontendController::class, 'annual_reports'])->name('annual-reports');
Route::get('/executive-committee', [FrontendController::class, 'executive_committee'])->name('executive-committee');
Route::get('/special-invitees', [FrontendController::class, 'special_invitees'])->name('special-invitees');
Route::get('/sub-committees', [FrontendController::class, 'sub_committees'])->name('sub-committees');
Route::get('/advisory-board', [FrontendController::class, 'advisory_board'])->name('advisory-board');
Route::get('/office-bearers', [FrontendController::class, 'office_bearers'])->name('office-bearers');
Route::get('/login', [FrontendController::class, 'login'])->name('user-login');

// ── ADMIN AUTH (public) ────────────────────────────────────────────────────
Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'authenticate'])->name('admin.authenticate');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// ── ADMIN PANEL (protected) ────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // ── Registrations
    Route::prefix('registration')->name('registration.')->group(function () {
        Route::get('/personal',    [RegistrationController::class, 'personal'])->name('personal');
        Route::get('/association', [RegistrationController::class, 'association'])->name('association');
        Route::get('/pending',     [RegistrationController::class, 'pending'])->name('pending');
        Route::get('/approved',    [RegistrationController::class, 'approved'])->name('approved');
        Route::get('/rejected',    [RegistrationController::class, 'rejected'])->name('rejected');
    });

    // ── Certificates
    Route::prefix('certificates')->name('certificates.')->group(function () {
        Route::get('/templates',    [CertificateController::class, 'templates'])->name('templates');
        Route::get('/personal',     [CertificateController::class, 'personal'])->name('personal');
        Route::get('/association',  [CertificateController::class, 'association'])->name('association');
        Route::get('/generated',    [CertificateController::class, 'generated'])->name('generated');
        Route::get('/verification', [CertificateController::class, 'verification'])->name('verification');
    });

    // ── Members
    Route::prefix('members')->name('members.')->group(function () {
        Route::get('/',            [MemberController::class, 'index'])->name('index');
        Route::get('/categories',  [MemberController::class, 'categories'])->name('categories');
    });

    // ── Events
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/',             [EventController::class, 'index'])->name('index');
        Route::get('/registrations',[EventController::class, 'registrations'])->name('registrations');
    });

    // ── Gallery
    Route::prefix('gallery')->name('gallery.')->group(function () {
        Route::get('/albums', [GalleryController::class, 'albums'])->name('albums');
        Route::get('/images', [GalleryController::class, 'images'])->name('images');
    });

    // ── Communication
    Route::prefix('communication')->name('communication.')->group(function () {
        Route::get('/notifications', [CommunicationController::class, 'notifications'])->name('notifications');
        Route::get('/circulars',     [CommunicationController::class, 'circulars'])->name('circulars');
        Route::get('/newsletter',    [CommunicationController::class, 'newsletter'])->name('newsletter');
        Route::get('/enquiries',     [CommunicationController::class, 'enquiries'])->name('enquiries');
    });

    // ── Documents
    Route::prefix('documents')->name('documents.')->group(function () {
        Route::get('/reports',   [DocumentController::class, 'reports'])->name('reports');
        Route::get('/downloads', [DocumentController::class, 'downloads'])->name('downloads');
    });

    // ── CMS
    Route::prefix('cms')->name('cms.')->group(function () {
        Route::get('/home',    [CmsController::class, 'home'])->name('home');
        Route::get('/about',   [CmsController::class, 'about'])->name('about');
        Route::get('/contact', [CmsController::class, 'contact'])->name('contact');
        Route::get('/dynamic', [CmsController::class, 'dynamic'])->name('dynamic');
    });

    // ── Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/website', [SettingController::class, 'website'])->name('website');
        Route::get('/email',   [SettingController::class, 'email'])->name('email');
        Route::get('/general', [SettingController::class, 'general'])->name('general');
    });

});

// Convenience redirect: /admin → /admin/dashboard
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});
