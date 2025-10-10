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
            ['name' => 'User Management', 'description' => 'Complete user database and profiles', 'is_active' => true, 'is_core' => true],
            ['name' => 'Staff & Trainer Management', 'description' => 'Organize team roles and schedules', 'is_active' => true, 'is_core' => true],
            ['name' => 'Check-In System', 'description' => 'QR code and hardware check-in support', 'is_active' => true, 'is_core' => true],
            ['name' => 'Reporting & Analytics', 'description' => 'Essential reports and analytics', 'is_active' => true, 'is_core' => true],
            ['name' => 'Email Support', 'description' => '24/7 email customer support', 'is_active' => true, 'is_core' => true],
            ['name' => 'Membership Management', 'description' => 'Manage memberships and subscriptions', 'is_active' => true, 'is_core' => true],
            ['name' => 'Class Management', 'description' => 'Manage classes and bookings', 'is_active' => true, 'is_core' => true],
            ['name' => 'Gym Scoring System', 'description' => 'Performance scoring and rankings', 'is_active' => true, 'is_core' => true],
            ['name' => 'Role-Based Permissions', 'description' => 'Advanced user permissions and security', 'is_active' => true, 'is_core' => true],
            ['name' => 'Branding & Customization', 'description' => 'Customize your gym with your content and color palette', 'is_active' => true, 'is_core' => true],
            ['name' => 'Invitations Management', 'description' => 'Invite users and staff to your gym', 'is_active' => true, 'is_core' => true],
            ['name' => 'Services Management', 'description' => 'Manage services and bookings', 'is_active' => true, 'is_core' => true],
            ['name' => 'Offers Management', 'description' => 'Manage offers and promotions', 'is_active' => true, 'is_core' => true],
            ['name' => 'Gym & Branch Deactivations', 'description' => 'Deactivate your gym or branches', 'is_active' => true, 'is_core' => true],
            ['name' => 'Financial Management', 'description' => 'Manage your gym\'s finances', 'is_active' => true, 'is_core' => true],
            
            // Advanced Features
            ['name' => 'Multi-Branch Management', 'description' => 'Manage multiple locations from one dashboard', 'is_active' => true, 'is_core' => false],
            ['name' => 'Different Payment Gateway Integration', 'description' => 'Automated billing and recurring payments', 'is_active' => true, 'is_core' => false],
            ['name' => 'Member Mobile App', 'description' => 'Dedicated mobile app for members', 'is_active' => true, 'is_core' => false],
            ['name' => 'Priority Support', 'description' => 'Phone and chat support with faster response', 'is_active' => true, 'is_core' => false],
            ['name' => 'Data Import Tool', 'description' => 'Migrate data from existing systems', 'is_active' => true, 'is_core' => false],
            ['name' => 'Locker Management', 'description' => 'Digital locker assignment and tracking', 'is_active' => true, 'is_core' => false],
            ['name' => 'Dedicated Account Manager', 'description' => 'Personal account manager for enterprise support', 'is_active' => true, 'is_core' => false],
            ['name' => 'Custom Integrations', 'description' => 'Tailored integrations with your systems', 'is_active' => true, 'is_core' => false],
            ['name' => 'On-Site Training', 'description' => 'In-person training for your team', 'is_active' => true, 'is_core' => false],
            ['name' => 'Notification & Announcements Management', 'description' => 'Manage notifications & announcements to users and staff', 'is_active' => true, 'is_core' => false],
            ['name' => 'Mobile Application', 'description' => 'Get your mobile application', 'is_active' => true, 'is_core' => false],
        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
}
