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
Route::get('/login', [FrontendController::class, 'login'])->name('login');

// ── ADMIN AUTH (public) ────────────────────────────────────────────────────
Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'authenticate'])->name('admin.authenticate');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// ── ADMIN PANEL (protected) ────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // ── Registrations ─────────────────────────────────────────────────────
    Route::prefix('registration')->name('registration.')->group(function () {
        Route::get('/personal',              [RegistrationController::class, 'personal'])->name('personal');
        Route::get('/association',           [RegistrationController::class, 'association'])->name('association');
        Route::get('/pending',               [RegistrationController::class, 'pending'])->name('pending');
        Route::get('/approved',              [RegistrationController::class, 'approved'])->name('approved');
        Route::get('/rejected',              [RegistrationController::class, 'rejected'])->name('rejected');
        Route::post('/store',                [RegistrationController::class, 'store'])->name('store');
        Route::get('/{id}/show',             [RegistrationController::class, 'show'])->name('show');
        Route::put('/{id}/update',           [RegistrationController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy',       [RegistrationController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/approve',         [RegistrationController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject',          [RegistrationController::class, 'reject'])->name('reject');
        Route::post('/{id}/issue-certificate',[RegistrationController::class, 'issueCertificate'])->name('issue-certificate');
    });

    // ── Certificates ──────────────────────────────────────────────────────
    Route::prefix('certificates')->name('certificates.')->group(function () {
        // Templates
        Route::get('/templates',             [CertificateController::class, 'templates'])->name('templates');
        Route::post('/templates/store',      [CertificateController::class, 'templateStore'])->name('templates.store');
        Route::get('/templates/{id}',        [CertificateController::class, 'templateShow'])->name('templates.show');
        Route::put('/templates/{id}',        [CertificateController::class, 'templateUpdate'])->name('templates.update');
        Route::delete('/templates/{id}',     [CertificateController::class, 'templateDestroy'])->name('templates.destroy');
        // Personal
        Route::get('/personal',              [CertificateController::class, 'personal'])->name('personal');
        Route::get('/personal/{id}',         [CertificateController::class, 'personalShow'])->name('personal.show');
        Route::put('/personal/{id}',         [CertificateController::class, 'personalUpdate'])->name('personal.update');
        Route::delete('/personal/{id}',      [CertificateController::class, 'personalDestroy'])->name('personal.destroy');
        // Association
        Route::get('/association',           [CertificateController::class, 'association'])->name('association');
        Route::post('/association/store',    [CertificateController::class, 'associationStore'])->name('association.store');
        Route::get('/association/{id}',      [CertificateController::class, 'associationShow'])->name('association.show');
        Route::put('/association/{id}',      [CertificateController::class, 'associationUpdate'])->name('association.update');
        Route::delete('/association/{id}',   [CertificateController::class, 'associationDestroy'])->name('association.destroy');
        // Generator & Verification
        Route::get('/generated',             [CertificateController::class, 'generated'])->name('generated');
        Route::get('/verification',          [CertificateController::class, 'verification'])->name('verification');
    });

    // ── Members ───────────────────────────────────────────────────────────
    Route::prefix('members')->name('members.')->group(function () {
        Route::get('/',               [MemberController::class, 'index'])->name('index');
        Route::post('/store',         [MemberController::class, 'store'])->name('store');
        Route::get('/{id}',           [MemberController::class, 'show'])->name('show');
        Route::put('/{id}',           [MemberController::class, 'update'])->name('update');
        Route::delete('/{id}',        [MemberController::class, 'destroy'])->name('destroy');
        // Categories
        Route::get('/categories/list',     [MemberController::class, 'categories'])->name('categories');
        Route::post('/categories/store',   [MemberController::class, 'categoryStore'])->name('categories.store');
        Route::get('/categories/{id}',     [MemberController::class, 'categoryShow'])->name('categories.show');
        Route::put('/categories/{id}',     [MemberController::class, 'categoryUpdate'])->name('categories.update');
        Route::delete('/categories/{id}',  [MemberController::class, 'categoryDestroy'])->name('categories.destroy');
    });

    // ── Events ────────────────────────────────────────────────────────────
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/',                     [EventController::class, 'index'])->name('index');
        Route::post('/store',               [EventController::class, 'store'])->name('store');
        Route::get('/{id}/show',            [EventController::class, 'show'])->name('show');
        Route::put('/{id}',                 [EventController::class, 'update'])->name('update');
        Route::delete('/{id}',              [EventController::class, 'destroy'])->name('destroy');
        Route::get('/registrations',        [EventController::class, 'registrations'])->name('registrations');
        Route::post('/registrations/store', [EventController::class, 'registrationStore'])->name('registrations.store');
        Route::get('/registrations/{id}',   [EventController::class, 'registrationShow'])->name('registrations.show');
        Route::put('/registrations/{id}',   [EventController::class, 'registrationUpdate'])->name('registrations.update');
        Route::delete('/registrations/{id}',[EventController::class, 'registrationDestroy'])->name('registrations.destroy');
    });

    // ── Gallery ───────────────────────────────────────────────────────────
    Route::prefix('gallery')->name('gallery.')->group(function () {
        Route::get('/albums',          [GalleryController::class, 'albums'])->name('albums');
        Route::post('/albums/store',   [GalleryController::class, 'albumStore'])->name('albums.store');
        Route::get('/albums/{id}',     [GalleryController::class, 'albumShow'])->name('albums.show');
        Route::put('/albums/{id}',     [GalleryController::class, 'albumUpdate'])->name('albums.update');
        Route::delete('/albums/{id}',  [GalleryController::class, 'albumDestroy'])->name('albums.destroy');
        Route::get('/images',          [GalleryController::class, 'images'])->name('images');
        Route::post('/images/store',   [GalleryController::class, 'imageStore'])->name('images.store');
        Route::get('/images/{id}',     [GalleryController::class, 'imageShow'])->name('images.show');
        Route::put('/images/{id}',     [GalleryController::class, 'imageUpdate'])->name('images.update');
        Route::delete('/images/{id}',  [GalleryController::class, 'imageDestroy'])->name('images.destroy');
    });

    // ── Communication ─────────────────────────────────────────────────────
    Route::prefix('communication')->name('communication.')->group(function () {
        Route::get('/notifications',            [CommunicationController::class, 'notifications'])->name('notifications');
        Route::post('/notifications/store',     [CommunicationController::class, 'notificationStore'])->name('notifications.store');
        Route::get('/notifications/{id}',       [CommunicationController::class, 'notificationShow'])->name('notifications.show');
        Route::put('/notifications/{id}',       [CommunicationController::class, 'notificationUpdate'])->name('notifications.update');
        Route::delete('/notifications/{id}',    [CommunicationController::class, 'notificationDestroy'])->name('notifications.destroy');
        Route::get('/circulars',                [CommunicationController::class, 'circulars'])->name('circulars');
        Route::post('/circulars/store',         [CommunicationController::class, 'circularStore'])->name('circulars.store');
        Route::get('/circulars/{id}',           [CommunicationController::class, 'circularShow'])->name('circulars.show');
        Route::put('/circulars/{id}',           [CommunicationController::class, 'circularUpdate'])->name('circulars.update');
        Route::delete('/circulars/{id}',        [CommunicationController::class, 'circularDestroy'])->name('circulars.destroy');
        Route::get('/newsletter',               [CommunicationController::class, 'newsletter'])->name('newsletter');
        Route::post('/newsletter/store',        [CommunicationController::class, 'newsletterStore'])->name('newsletter.store');
        Route::get('/newsletter/{id}',          [CommunicationController::class, 'newsletterShow'])->name('newsletter.show');
        Route::put('/newsletter/{id}',          [CommunicationController::class, 'newsletterUpdate'])->name('newsletter.update');
        Route::delete('/newsletter/{id}',       [CommunicationController::class, 'newsletterDestroy'])->name('newsletter.destroy');
        Route::get('/enquiries',                [CommunicationController::class, 'enquiries'])->name('enquiries');
        Route::get('/enquiries/{id}',           [CommunicationController::class, 'enquiryShow'])->name('enquiries.show');
        Route::put('/enquiries/{id}',           [CommunicationController::class, 'enquiryUpdate'])->name('enquiries.update');
        Route::delete('/enquiries/{id}',        [CommunicationController::class, 'enquiryDestroy'])->name('enquiries.destroy');
    });

    // ── Documents ─────────────────────────────────────────────────────────
    Route::prefix('documents')->name('documents.')->group(function () {
        Route::get('/reports',          [DocumentController::class, 'reports'])->name('reports');
        Route::post('/reports/store',   [DocumentController::class, 'reportStore'])->name('reports.store');
        Route::get('/reports/{id}',     [DocumentController::class, 'reportShow'])->name('reports.show');
        Route::post('/reports/{id}',    [DocumentController::class, 'reportUpdate'])->name('reports.update');
        Route::delete('/reports/{id}',  [DocumentController::class, 'reportDestroy'])->name('reports.destroy');
        Route::get('/downloads',            [DocumentController::class, 'downloads'])->name('downloads');
        Route::post('/downloads/store',     [DocumentController::class, 'downloadStore'])->name('downloads.store');
        Route::get('/downloads/{id}',       [DocumentController::class, 'downloadShow'])->name('downloads.show');
        Route::post('/downloads/{id}',      [DocumentController::class, 'downloadUpdate'])->name('downloads.update');
        Route::delete('/downloads/{id}',    [DocumentController::class, 'downloadDestroy'])->name('downloads.destroy');
    });

    // ── CMS ───────────────────────────────────────────────────────────────
    Route::prefix('cms')->name('cms.')->group(function () {
        Route::get('/home',    [CmsController::class, 'home'])->name('home');
        Route::get('/about',   [CmsController::class, 'about'])->name('about');
        Route::get('/contact', [CmsController::class, 'contact'])->name('contact');
        Route::get('/dynamic', [CmsController::class, 'dynamic'])->name('dynamic');
    });

    // ── Settings ──────────────────────────────────────────────────────────
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/website', [SettingController::class, 'website'])->name('website');
        Route::get('/email',   [SettingController::class, 'email'])->name('email');
        Route::get('/general', [SettingController::class, 'general'])->name('general');
    });

});

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});
