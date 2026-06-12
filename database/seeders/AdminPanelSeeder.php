<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminPanelSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Admin User ─────────────────────────────────────────────
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@pactpunjab.in'],
            [
                'name'       => 'Super Admin',
                'email'      => 'admin@pactpunjab.in',
                'password'   => Hash::make('password'),
                'is_admin'   => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // ── 2. Member Categories (10) ─────────────────────────────────
        $categories = [
            ['name' => 'Life Member',        'annual_fee' => 5000.00, 'status' => 'Active'],
            ['name' => 'Regular Member',     'annual_fee' => 1200.00, 'status' => 'Active'],
            ['name' => 'Associate Member',   'annual_fee' => 800.00,  'status' => 'Active'],
            ['name' => 'Student Member',     'annual_fee' => 300.00,  'status' => 'Active'],
            ['name' => 'Honorary Member',    'annual_fee' => 0.00,    'status' => 'Active'],
            ['name' => 'Corporate Member',   'annual_fee' => 8000.00, 'status' => 'Active'],
            ['name' => 'Senior Member',      'annual_fee' => 2000.00, 'status' => 'Active'],
            ['name' => 'Junior Member',      'annual_fee' => 600.00,  'status' => 'Active'],
            ['name' => 'Patron Member',      'annual_fee' => 15000.00,'status' => 'Active'],
            ['name' => 'Affiliate Member',   'annual_fee' => 1500.00, 'status' => 'Inactive'],
        ];
        DB::table('member_categories')->truncate();
        foreach ($categories as $cat) {
            DB::table('member_categories')->insert(array_merge($cat, [
                'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // ── 3. Members (50) ──────────────────────────────────────────
        $memberNames = [
            'Rajesh Kumar','Priya Sharma','Amit Singh','Sunita Patel','Vikram Mehta',
            'Anita Joshi','Manoj Verma','Kavitha Rao','Deepak Nair','Meena Agarwal',
            'Suresh Gupta','Rekha Pandey','Ramesh Chandra','Sonia Kapoor','Arjun Malhotra',
            'Pooja Srivastava','Naresh Bansal','Geeta Tiwari','Harish Sharma','Nisha Yadav',
            'Pankaj Jain','Sunita Devi','Arun Kumar','Seema Verma','Manish Saxena',
            'Ritu Singh','Dinesh Gupta','Kavita Mishra','Sunil Tripathi','Alka Shukla',
            'Mukesh Agarwal','Shweta Sharma','Rahul Chaudhary','Priyanka Dubey','Ajay Yadav',
            'Neha Gupta','Sanjeev Kumar','Swati Joshi','Vinod Pandey','Archana Singh',
            'Rakesh Tiwari','Anita Kumari','Vivek Sharma','Preeti Agarwal','Gaurav Verma',
            'Manju Rani','Sanjay Kumar','Deepa Sharma','Ashok Gupta','Sarla Devi',
        ];
        $firms = [
            'TechPoint Solutions','Digital Hub Ludhiana','Cyber World Amritsar','IT Connect Jalandhar',
            'CompuTech Services','DataSync Punjab','Net Solutions','Hardware Hub','Byte Solutions',
            'Pixel Technologies','Cloud Nine IT','Smart Tech','Infotech Systems','Alpha Computers',
            'Beta Solutions','Gamma Tech','Delta IT','Epsilon Systems','Zeta Computers',
            'Eta Networks','Theta Digital','Iota IT Services','Kappa Cyber','Lambda Technologies',
            'Mu Solutions','Nu Computers','Xi Systems','Omicron IT','Pi Tech Hub',
            'Rho Digital','Sigma Networks','Tau Solutions','Upsilon Computers','Phi Technologies',
            'Chi Systems','Psi IT','Omega Cyber','Aleph Tech','Beth Solutions',
            'Gimel IT','Dalet Systems','He Computers','Vav Networks','Zayin Digital',
            'Chet IT Hub','Tet Solutions','Yod Tech','Kaf Computers','Lamed IT',
        ];
        $categoryIds = DB::table('member_categories')->pluck('id')->toArray();
        $statuses = ['Active','Active','Active','Active','Inactive','Pending'];
        $firmCount = count($firms);

        DB::table('members')->truncate();
        foreach ($memberNames as $i => $name) {
            DB::table('members')->insert([
                'member_id'    => 'MEM-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'name'         => $name,
                'firm_company' => $firms[$i % $firmCount],
                'category_id'  => $categoryIds[array_rand($categoryIds)],
                'status'       => $statuses[array_rand($statuses)],
                'created_at'   => Carbon::now()->subDays(rand(1, 365)),
                'updated_at'   => now(),
            ]);
        }

        // ── 4. Certification Registrations (50) ──────────────────────
        $associations = ['PACT Punjab','CAIT Punjab','NASSCOM Punjab','CSI Ludhiana Chapter','IAMAI Punjab'];
        $districts = ['Ludhiana','Amritsar','Jalandhar','Patiala','Bathinda','Mohali','Hoshiarpur','Gurdaspur','Ferozepur','Faridkot'];
        $services = ['Hardware Sales','Software Sales','IT Services','Networking','Cloud Solutions','CCTV Installation','Data Recovery','Printer Repairs'];
        $regStatuses = ['Pending','Pending','Approved','Approved','Approved','Rejected'];

        DB::table('certification_registrations')->truncate();
        foreach (range(1, 50) as $i) {
            DB::table('certification_registrations')->insert([
                'association'         => $associations[array_rand($associations)],
                'firm_name'           => $firms[($i - 1) % $firmCount],
                'district'            => $districts[array_rand($districts)],
                'address'             => rand(10,999) . ', Main Market, ' . $districts[array_rand($districts)],
                'proprietor'          => $memberNames[($i - 1) % 50],
                'mobile_primary'      => '9' . rand(700000000, 899999999),
                'contact2_name'       => rand(0,1) ? $memberNames[rand(0,49)] : null,
                'mobile_secondary'    => rand(0,1) ? '9' . rand(700000000, 899999999) : null,
                'email'               => strtolower(str_replace(' ', '.', $memberNames[($i-1) % 50])) . rand(1,99) . '@gmail.com',
                'website'             => rand(0,1) ? 'www.' . strtolower(str_replace([' ','&'], ['',''], $firms[($i-1) % $firmCount])) . '.in' : null,
                'portal'              => null,
                'companies_dealt_with'=> 'HP, Dell, Lenovo, ' . ($i % 2 == 0 ? 'Acer, Asus' : 'Samsung, Epson'),
                'services_offered'    => json_encode(array_slice($services, 0, rand(2, 5))),
                'status'              => $regStatuses[array_rand($regStatuses)],
                'created_at'          => Carbon::now()->subDays(rand(1, 180)),
                'updated_at'          => now(),
            ]);
        }

        // ── 5. Certificate Templates (10) ─────────────────────────────
        DB::table('certificate_templates')->truncate();
        $templates = [
            ['name'=>'Standard Membership Certificate','orientation'=>'landscape','status'=>'Active'],
            ['name'=>'Premium Gold Certificate',       'orientation'=>'landscape','status'=>'Active'],
            ['name'=>'Association Recognition Award',  'orientation'=>'landscape','status'=>'Active'],
            ['name'=>'Excellence Award Certificate',   'orientation'=>'portrait', 'status'=>'Active'],
            ['name'=>'Participation Certificate',      'orientation'=>'landscape','status'=>'Active'],
            ['name'=>'Leadership Award',               'orientation'=>'landscape','status'=>'Active'],
            ['name'=>'Annual Achievement Certificate', 'orientation'=>'landscape','status'=>'Active'],
            ['name'=>'Best Trader Award',              'orientation'=>'portrait', 'status'=>'Active'],
            ['name'=>'Merit Certificate',              'orientation'=>'landscape','status'=>'Inactive'],
            ['name'=>'Honorary Membership Certificate','orientation'=>'landscape','status'=>'Active'],
        ];
        foreach ($templates as $t) {
            DB::table('certificate_templates')->insert(array_merge($t, [
                'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // ── 6. Personal Certificates (50) ────────────────────────────
        $certStatuses = ['Active','Active','Active','Expired','Active'];
        DB::table('personal_certificates')->truncate();
        foreach (range(1, 50) as $i) {
            $issueDate = Carbon::now()->subDays(rand(30, 730));
            DB::table('personal_certificates')->insert([
                'cert_id'     => 'PCERT-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'issued_to'   => $memberNames[($i - 1) % 50],
                'issue_date'  => $issueDate->toDateString(),
                'expiry_date' => $issueDate->copy()->addYears(3)->toDateString(),
                'status'      => $certStatuses[array_rand($certStatuses)],
                'created_at'  => $issueDate,
                'updated_at'  => now(),
            ]);
        }

        // ── 7. Association Certificates (50) ─────────────────────────
        $assocNames = [
            'PACT Ludhiana Chapter','CAIT Amritsar Unit','IT Traders Jalandhar','Cyber Hub Patiala',
            'Tech Association Bathinda','CompuTrade Mohali','Digital Bazaar Hoshiarpur',
            'IT Circle Gurdaspur','Byte Traders Ferozepur','Hardware Mandi Faridkot',
        ];
        DB::table('association_certificates')->truncate();
        foreach (range(1, 50) as $i) {
            $issueDate = Carbon::now()->subDays(rand(30, 730));
            DB::table('association_certificates')->insert([
                'cert_id'          => 'ACERT-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'association_name' => $assocNames[($i - 1) % count($assocNames)],
                'issue_date'       => $issueDate->toDateString(),
                'expiry_date'      => $issueDate->copy()->addYears(3)->toDateString(),
                'status'           => $certStatuses[array_rand($certStatuses)],
                'created_at'       => $issueDate,
                'updated_at'       => now(),
            ]);
        }

        // ── 8. Events (50) ───────────────────────────────────────────
        $eventNames = [
            'Annual General Meeting','Member Orientation Program','Technology Workshop',
            'Leadership Summit','Digital India Conclave','IT Trade Fair',
            'Certificate Distribution Ceremony','Networking Meet','Awards Night',
            'Training Session: GST for IT Traders','Seminar on Cybersecurity',
            'Women in Tech Forum','Startup Pitch Day','E-Commerce Workshop',
            'Cloud Computing Training','Data Privacy Awareness','Youth Innovators Meet',
            'Budget Briefing for IT Traders','Product Launch Event','Panel Discussion: Future of IT',
        ];
        $locations = ['Ludhiana','Amritsar','Jalandhar','Patiala','Mohali','Online','New Delhi','Mumbai','Chandigarh','Bathinda'];
        $eventStatuses = ['Active','Active','Active','Completed','Completed','Cancelled'];

        DB::table('events')->truncate();
        foreach (range(1, 50) as $i) {
            $eventDate = Carbon::now()->addDays(rand(-120, 120));
            DB::table('events')->insert([
                'event_id'   => 'EVT-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'name'       => $eventNames[($i - 1) % count($eventNames)] . ' ' . (2025 + ($i % 2)),
                'event_date' => $eventDate->toDateString(),
                'location'   => $locations[array_rand($locations)],
                'status'     => $eventStatuses[array_rand($eventStatuses)],
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => now(),
            ]);
        }

        // ── 9. Event Registrations (50) ──────────────────────────────
        $eventIds   = DB::table('events')->pluck('id')->toArray();
        $payStatuses = ['Paid','Paid','Pending'];
        $regStatus2  = ['Confirmed','Confirmed','Pending','Cancelled'];

        DB::table('event_registrations')->truncate();
        foreach (range(1, 50) as $i) {
            DB::table('event_registrations')->insert([
                'reg_id'         => 'EREG-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'attendee_name'  => $memberNames[($i - 1) % 50],
                'event_id'       => $eventIds[array_rand($eventIds)],
                'payment_status' => $payStatuses[array_rand($payStatuses)],
                'status'         => $regStatus2[array_rand($regStatus2)],
                'created_at'     => Carbon::now()->subDays(rand(1, 90)),
                'updated_at'     => now(),
            ]);
        }

        // ── 10. Albums (20) ──────────────────────────────────────────
        $albumTitles = [
            'Annual General Meeting 2025','Member Orientation Jan 2025','Technology Workshop Feb 2025',
            'Leadership Summit 2024','IT Trade Fair 2024','Certificate Ceremony Dec 2024',
            'Networking Meet Nov 2024','Awards Night 2024','Training Session Oct 2024',
            'Seminar Cybersecurity Sep 2024','Women in Tech Aug 2024','Startup Pitch Day Jul 2024',
            'E-Commerce Workshop Jun 2024','Cloud Training May 2024','Digital India Apr 2024',
            'Youth Innovators Mar 2024','Budget Briefing Feb 2024','Product Launch Jan 2024',
            'Panel Discussion Dec 2023','Campus Visit Nov 2023',
        ];
        $albumStatuses = ['Published','Published','Published','Draft'];

        DB::table('albums')->truncate();
        foreach ($albumTitles as $i => $title) {
            DB::table('albums')->insert([
                'title'      => $title,
                'status'     => $albumStatuses[array_rand($albumStatuses)],
                'created_at' => Carbon::now()->subDays(rand(10, 400)),
                'updated_at' => now(),
            ]);
        }

        // ── 11. Images (50) ──────────────────────────────────────────
        $albumIds = DB::table('albums')->pluck('id')->toArray();
        $imageStatuses = ['Active','Active','Active','Inactive'];

        DB::table('images')->truncate();
        foreach (range(1, 50) as $i) {
            DB::table('images')->insert([
                'album_id'   => $albumIds[array_rand($albumIds)],
                'file_path'  => 'gallery/img_' . str_pad($i, 3, '0', STR_PAD_LEFT) . '.jpg',
                'title'      => 'Photo ' . $i,
                'status'     => $imageStatuses[array_rand($imageStatuses)],
                'created_at' => Carbon::now()->subDays(rand(1, 300)),
                'updated_at' => now(),
            ]);
        }

        // ── 12. Circulars (50) ───────────────────────────────────────
        $circularSubjects = [
            'Annual Subscription Fee Notice','GST Filing Reminder for Members',
            'New Certification Process Update','Changes in Association Bye-Laws',
            'Upcoming AGM Notice','Election of Office Bearers','Holiday Notice',
            'Seminar Invitation','Trade Fair Registration Open','Policy Update: Returns & Refunds',
            'IT Act Amendment Briefing','New Member Welcome Notice','Awards Nominations Open',
            'Revised Fee Structure','Compliance Deadline Reminder','Digital Signature Requirement',
            'Cyber Crime Awareness','Association Membership Renewal','New Branch Office Opening',
            'Annual Report Published',
        ];
        $audiences   = ['All Members','Association Members','New Members','Corporate Members','Life Members'];
        $circStatuses = ['Published','Published','Published','Draft'];

        DB::table('circulars')->truncate();
        foreach (range(1, 50) as $i) {
            DB::table('circulars')->insert([
                'circular_id'     => 'CIR-' . date('Y') . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'subject'         => $circularSubjects[($i - 1) % count($circularSubjects)] . ' #' . $i,
                'date_issued'     => Carbon::now()->subDays(rand(1, 300))->toDateString(),
                'target_audience' => $audiences[array_rand($audiences)],
                'status'          => $circStatuses[array_rand($circStatuses)],
                'created_at'      => Carbon::now()->subDays(rand(1, 300)),
                'updated_at'      => now(),
            ]);
        }

        // ── 13. Enquiries (50) ───────────────────────────────────────
        $enquirySubjects = [
            'Membership Registration Query','Certificate Verification Request',
            'Event Registration Issue','Fee Payment Clarification','Branch Contact Info Request',
            'Document Upload Problem','Login Access Issue','Member Benefits Query',
            'Renewal Process Question','New Member Onboarding','Refund Request',
            'Workshop Schedule Query','Support for Documentation','Technical Issue Report',
            'General Information Request',
        ];
        $enqStatuses = ['Open','Open','Resolved','Closed'];

        DB::table('enquiries')->truncate();
        foreach (range(1, 50) as $i) {
            DB::table('enquiries')->insert([
                'enquiry_id'  => 'ENQ-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'sender_name' => $memberNames[$i - 1],
                'subject'     => $enquirySubjects[($i - 1) % count($enquirySubjects)],
                'status'      => $enqStatuses[array_rand($enqStatuses)],
                'created_at'  => Carbon::now()->subDays(rand(1, 120)),
                'updated_at'  => now(),
            ]);
        }

        // ── 14. Notifications (50) ───────────────────────────────────
        $notifTitles = [
            'Welcome to PACT Punjab!','Your certificate is ready for download.',
            'Registration approved successfully.','New event added: Annual General Meeting.',
            'Membership renewal reminder.','Fee payment confirmation received.',
            'New circular published.','Your enquiry has been resolved.',
            'Event registration confirmed.','System maintenance scheduled.',
            'Password reset successful.','Profile updated successfully.',
            'New member joined your chapter.','Election results announced.',
            'Annual report now available for download.',
        ];
        $notifMessages = [
            'Dear member, your registration with PACT Punjab has been approved. Welcome aboard!',
            'Your certificate has been generated and is ready for download from your dashboard.',
            'A new event has been scheduled. Please register early to secure your seat.',
            'Your membership renewal is due in 30 days. Please renew to continue enjoying benefits.',
            'Payment of ₹1,200 received successfully for Annual Membership 2025-26.',
            'A new circular has been published. Please review the latest updates from the association.',
            'Your enquiry (ENQ-0012) has been resolved. Thank you for reaching out to us.',
            'Server maintenance is scheduled on Sunday 2:00 AM – 4:00 AM IST.',
            'The Annual General Meeting is scheduled for 14 June 2026 at New Delhi.',
            'Your profile information has been updated successfully.',
        ];
        $notifStatuses = ['Active','Active','Active','Inactive'];

        DB::table('notifications')->truncate();
        foreach (range(1, 50) as $i) {
            DB::table('notifications')->insert([
                'title'      => $notifTitles[($i - 1) % count($notifTitles)],
                'message'    => $notifMessages[($i - 1) % count($notifMessages)],
                'status'     => $notifStatuses[array_rand($notifStatuses)],
                'created_at' => Carbon::now()->subDays(rand(1, 90)),
                'updated_at' => now(),
            ]);
        }

        // ── 15. Newsletters (50) ─────────────────────────────────────
        $newsletterSubjects = [
            'PACT Punjab Monthly Bulletin – June 2026',
            'IT Trade Update – May 2026',
            'Association News – April 2026',
            'Member Spotlight – March 2026',
            'Event Highlights – February 2026',
            'Annual Report Summary – 2025',
            'New Initiatives from PACT Punjab – January 2026',
            'Tech Trends for Computer Traders – December 2025',
            'Policy Updates for IT Businesses – November 2025',
            'Year-End Review – October 2025',
        ];
        $newsletterStatuses = ['Sent','Sent','Sent','Draft'];

        DB::table('newsletters')->truncate();
        foreach (range(1, 50) as $i) {
            $sentDate = Carbon::now()->subDays(rand(5, 365));
            DB::table('newsletters')->insert([
                'subject'    => $newsletterSubjects[($i - 1) % count($newsletterSubjects)] . ' #' . $i,
                'sent_date'  => $sentDate->toDateString(),
                'status'     => $newsletterStatuses[array_rand($newsletterStatuses)],
                'created_at' => $sentDate,
                'updated_at' => now(),
            ]);
        }

        // ── 16. Reports (50) ─────────────────────────────────────────
        $reportTitles = [
            'Annual Report 2025','Annual Report 2024','Annual Report 2023',
            'Quarterly Report Q1 2026','Quarterly Report Q4 2025',
            'Quarterly Report Q3 2025','Quarterly Report Q2 2025',
            'Member Survey Results 2025','IT Trade Statistics Punjab 2025',
            'Event Impact Report 2024','Financial Audit Report 2024',
            'Membership Growth Analysis 2024','Technology Adoption Report 2023',
            'Business Environment Report 2023','Digital India Progress Report 2022',
        ];
        $reportStatuses = ['Published','Published','Published','Draft'];

        DB::table('reports')->truncate();
        foreach (range(1, 50) as $i) {
            DB::table('reports')->insert([
                'title'      => $reportTitles[($i - 1) % count($reportTitles)] . ' Vol.' . $i,
                'file_path'  => 'reports/report_' . str_pad($i, 3, '0', STR_PAD_LEFT) . '.pdf',
                'status'     => $reportStatuses[array_rand($reportStatuses)],
                'created_at' => Carbon::now()->subDays(rand(1, 500)),
                'updated_at' => now(),
            ]);
        }

        // ── 17. Downloads (50) ───────────────────────────────────────
        $downloadTitles = [
            'Membership Application Form 2025','Association Registration Form',
            'Certificate Request Form','Event Registration Form',
            'Renewal Application Form 2025','KYC Document Checklist',
            'Trade License Template','GST Registration Guide for IT Traders',
            'MSME Registration Guide','Bye-Laws of PACT Punjab',
            'Constitution of the Association','Code of Conduct for Members',
            'Annual Fee Structure 2025-26','IT Act Quick Reference Card',
            'Cybersecurity Best Practices Guide','Data Protection Policy',
        ];
        $downloadStatuses = ['Active','Active','Active','Inactive'];

        DB::table('downloads')->truncate();
        foreach (range(1, 50) as $i) {
            DB::table('downloads')->insert([
                'title'      => $downloadTitles[($i - 1) % count($downloadTitles)] . ' v' . $i,
                'file_path'  => 'downloads/doc_' . str_pad($i, 3, '0', STR_PAD_LEFT) . '.pdf',
                'status'     => $downloadStatuses[array_rand($downloadStatuses)],
                'created_at' => Carbon::now()->subDays(rand(1, 400)),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅  All tables seeded successfully with 50 records each!');
        $this->command->info('🔑  Admin login: admin@pactpunjab.in  |  password: password');
    }
}
