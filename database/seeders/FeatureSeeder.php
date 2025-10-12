<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            // Core Features (available in all plans)
            ['name' => 'User Management', 'description' => 'Complete user database and profiles', 'is_active' => true, 'is_core' => true, 'is_hidden' => false],
            ['name' => 'Staff & Trainer Management', 'description' => 'Organize team roles and schedules', 'is_active' => true, 'is_core' => true, 'is_hidden' => false],
            ['name' => 'Check-In System', 'description' => 'QR code and hardware check-in support', 'is_active' => true, 'is_core' => true, 'is_hidden' => false],
            ['name' => 'Reporting & Analytics', 'description' => 'Essential reports and analytics', 'is_active' => true, 'is_core' => true, 'is_hidden' => false],
            ['name' => 'Email Support', 'description' => '24/7 email customer support', 'is_active' => true, 'is_core' => true, 'is_hidden' => false],
            ['name' => 'Membership Management', 'description' => 'Manage memberships and subscriptions', 'is_active' => true, 'is_core' => true, 'is_hidden' => false],
            ['name' => 'Class Management', 'description' => 'Manage classes and bookings', 'is_active' => true, 'is_core' => true, 'is_hidden' => false],
            ['name' => 'Gym Scoring System', 'description' => 'Performance scoring and rankings', 'is_active' => true, 'is_core' => true, 'is_hidden' => false],
            ['name' => 'Role-Based Permissions', 'description' => 'Advanced user permissions and security', 'is_active' => true, 'is_core' => true, 'is_hidden' => false],
            ['name' => 'Branding & Customization', 'description' => 'Customize your gym with your content and color palette', 'is_active' => true, 'is_core' => true, 'is_hidden' => false],
            ['name' => 'Invitations Management', 'description' => 'Invite users and staff to your gym', 'is_active' => true, 'is_core' => true, 'is_hidden' => false],
            ['name' => 'Services Management', 'description' => 'Manage services and bookings', 'is_active' => true, 'is_core' => true, 'is_hidden' => false],
            ['name' => 'Offers Management', 'description' => 'Manage offers and promotions', 'is_active' => true, 'is_core' => true, 'is_hidden' => false],
            ['name' => 'Gym & Branch Deactivations', 'description' => 'Deactivate your gym or branches', 'is_active' => true, 'is_core' => true, 'is_hidden' => true],
            ['name' => 'Payment Management', 'description' => 'Manage your gym\'s finances', 'is_active' => true, 'is_core' => true, 'is_hidden' => false],
            ['name' => 'Cash Payment Management', 'description' => 'Manage your gym\'s cash payments', 'is_active' => true, 'is_core' => true, 'is_hidden' => true],
            ['name' => 'Resources Management', 'description' => 'Manage your resources', 'is_active' => true, 'is_core' => true, 'is_hidden' => true],
            
            // Advanced Features
            ['name' => 'Multi-Branch Management', 'description' => 'Manage multiple locations from one dashboard', 'is_active' => true, 'is_core' => false, 'is_hidden' => false],
            ['name' => 'Different Payment Gateway Integration', 'description' => 'Automated billing and recurring payments', 'is_active' => true, 'is_core' => false, 'is_hidden' => false],
            ['name' => 'Member Mobile App', 'description' => 'Dedicated mobile app for members', 'is_active' => true, 'is_core' => false, 'is_hidden' => false],
            ['name' => 'Priority Support', 'description' => 'Phone and chat support with faster response', 'is_active' => true, 'is_core' => false, 'is_hidden' => false],
            ['name' => 'Data Import Tool', 'description' => 'Migrate data from existing systems', 'is_active' => true, 'is_core' => false, 'is_hidden' => false],
            ['name' => 'Locker Management', 'description' => 'Digital locker assignment and tracking', 'is_active' => true, 'is_core' => false, 'is_hidden' => false],
            ['name' => 'Dedicated Account Manager', 'description' => 'Personal account manager for enterprise support', 'is_active' => true, 'is_core' => false, 'is_hidden' => false],
            ['name' => 'Custom Integrations', 'description' => 'Tailored integrations with your systems', 'is_active' => true, 'is_core' => false, 'is_hidden' => false],
            ['name' => 'On-Site Training', 'description' => 'In-person training for your team', 'is_active' => true, 'is_core' => false, 'is_hidden' => false],
            ['name' => 'Notification & Announcements Management', 'description' => 'Manage notifications & announcements to users and staff', 'is_active' => true, 'is_core' => false, 'is_hidden' => false],
            ['name' => 'Mobile Application', 'description' => 'Get your mobile application', 'is_active' => true, 'is_core' => false, 'is_hidden' => false],
            ['name' => 'AI Chatbot', 'description' => 'Get your AI chatbot', 'is_active' => true, 'is_core' => false, 'is_hidden' => false],
            ['name' => 'Blog Management', 'description' => 'Manage your blog', 'is_active' => true, 'is_core' => false, 'is_hidden' => false],
        ];

        foreach ($features as $feature) {
            // Generate key from name: lowercase with underscores
            $feature['key'] = strtolower(str_replace(['&', ' '], ['', '_'], $feature['name']));
            $feature['key'] = preg_replace('/_+/', '_', $feature['key']); // Remove duplicate underscores
            
            Feature::create($feature);
        }
    }
}
