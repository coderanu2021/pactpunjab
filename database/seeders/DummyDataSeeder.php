<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Settings (Batch 2 text-heavy pages)
        $settings = [
            ['key' => 'page_profile_intro', 'value' => 'The Punjab Association of Computer Traders (PACT) is the apex body representing IT traders across Punjab and Chandigarh.'],
            ['key' => 'page_profile_history', 'value' => 'Since 1996, PACT has worked tirelessly to unite the IT community, resolving trade disputes and advocating for trader-friendly policies.'],
            ['key' => 'page_profile_mission', 'value' => 'To foster growth and unity in the regional IT trade.'],
            ['key' => 'page_profile_vision', 'value' => 'A thriving and legally secure IT trade ecosystem in Punjab.'],
            
            ['key' => 'page_aims_intro', 'value' => 'Our primary objective is to safeguard the interests of IT traders.'],
            ['key' => 'page_aims_list', 'value' => '1. Policy Advocacy\n2. Trade Dispute Resolution\n3. GST Guidance\n4. Networking & Growth'],
            
            ['key' => 'page_contact_intro', 'value' => 'Reach out to the PACT secretariat for membership inquiries or grievances.'],
            ['key' => 'contact_address', 'value' => 'PACT Secretariat, Sector 17, Chandigarh, Punjab'],
            ['key' => 'contact_email', 'value' => 'info@pactpunjab.com'],
            ['key' => 'contact_phone', 'value' => '+91-98765-43210'],
            
            ['key' => 'page_conference_hall_intro', 'value' => 'Members can book our state-of-the-art conference hall for meetings and seminars at subsidized rates.'],
            
            ['key' => 'page_advisory_intro', 'value' => 'Expert advisory services provided to all members on legal and taxation matters.'],
            
            ['key' => 'page_registration_intro', 'value' => 'Download your PACT membership certificate here. It is valid for the current financial year.']
        ];
        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }

        // 2. Media Items (Coverage & Press Releases)
        \App\Models\MediaItem::create([
            'type' => 'press_release',
            'title' => 'PACT Announces Annual Meet 2025',
            'description' => 'The flagship Annual Meet 2025 will be held in Chandigarh.',
            'published_date' => now()->subDays(2),
            'outlet' => 'PACT Media',
            'icon' => '📣'
        ]);
        \App\Models\MediaItem::create([
            'type' => 'coverage',
            'title' => 'Punjab IT Trade Body Demands Faster GST Refunds',
            'description' => 'PACT pushes state for reform.',
            'published_date' => now()->subDays(10),
            'outlet' => 'The Tribune',
            'url' => 'https://tribuneindia.com',
            'icon' => '📰'
        ]);

        // 3. Reports
        \App\Models\Report::create([
            'title' => 'Annual Report 2023-24',
            'file_path' => 'dummy/report2024.pdf',
            'status' => 'Active',
            'created_at' => now()
        ]);
        \App\Models\Report::create([
            'title' => 'Annual Report 2022-23',
            'file_path' => 'dummy/report2023.pdf',
            'status' => 'Active',
            'created_at' => now()->subYear()
        ]);

        // 4. Events
        \App\Models\Event::create([
            'event_id' => 'EVT-' . uniqid(),
            'name' => 'IT Mahakumbh 2025',
            'description' => 'Annual mega event for IT traders.',
            'event_date' => now()->addDays(30),
            'location' => 'Chandigarh',
            'status' => 'Active',
            'category' => 'Annual Meet'
        ]);

        // 5. Downloads
        \App\Models\Download::create([
            'title' => 'Membership Application Form',
            'category' => 'Forms',
            'file_path' => 'dummy/membership_form.pdf',
            'status' => 'Active'
        ]);

        // 6. Albums
        \App\Models\Album::create([
            'title' => 'AGM 2023',
            'category' => 'AGM',
            'status' => 'Active'
        ]);
    }
}
