<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;
use App\Models\CommitteeMember;
use App\Models\Service;
use App\Models\Faq;

class CmsController extends Controller
{
    private function getSettings() {
        return Setting::pluck('value', 'key')->toArray();
    }

    public function home() {
        $settings = $this->getSettings();
        return view('admin.cms.home', compact('settings'));
    }

    public function updateSettings(Request $request) {
        $data = $request->except('_token');
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    public function about() {
        return view('admin.cms.about');
    }

    public function contact() {
        return view('admin.cms.contact');
    }

    public function dynamic() {
        return view('admin.cms.dynamic');
    }
}
