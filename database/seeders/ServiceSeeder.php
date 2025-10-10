<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Advanced Reporting',
                'description' => 'Get deep insights into performance, revenue, and member engagement through real-time, customizable reports that help you make smarter decisions.',
                'icon' => 'bi bi-graph-up',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Authentication & Authorization',
                'description' => 'Manage secure access for owners, staff, trainers, and members with flexible, role-based permissions for total control and safety.',
                'icon' => 'bi bi-shield-lock',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Branding & Customization',
                'description' => 'Personalize your gym dashboard with your own logo, colors, and brand identity for a consistent and premium digital presence.',
                'icon' => 'bi bi-brush',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Invitations Management',
                'description' => 'Invite staff, trainers, and members effortlessly with automated email or link-based invitations to simplify onboarding.',
                'icon' => 'bi bi-envelope-paper',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Memberships & Subscriptions',
                'description' => 'Manage flexible membership plans, renewals, and recurring payments with ease, boosting your retention and revenue.',
                'icon' => 'bi bi-credit-card',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Classes & Gym Services',
                'description' => 'Create and manage fitness classes, personal training sessions, and gym services with simple scheduling tools for your team and clients.',
                'icon' => 'bi bi-calendar-event',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Locker Management (Coming Soon)',
                'description' => 'Assign, monitor, and control locker usage digitally for added convenience and security — a smarter way to manage member storage.',
                'icon' => 'bi bi-box',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Smart Check-In System',
                'description' => 'Simplify member entry with QR code or hardware-based check-ins, improving efficiency and delivering a seamless gym experience.',
                'icon' => 'bi bi-qr-code-scan',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Gym Scoring System',
                'description' => 'Rank and display gyms by area, city, and performance score — helping members find top-rated gyms and boosting visibility for high-performing ones.',
                'icon' => 'bi bi-star',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'title' => 'Branches Management',
                'description' => 'Manage multiple gym branches from one dashboard — unify reporting, memberships, and staff management across all your locations.',
                'icon' => 'bi bi-diagram-3',
                'order' => 10,
                'is_active' => true,
            ],
            [
                'title' => 'Staff & Trainers Management',
                'description' => 'Organize your team efficiently — manage staff roles, trainer schedules, and performance tracking all in one intuitive platform.',
                'icon' => 'bi bi-person-badge',
                'order' => 11,
                'is_active' => true,
            ],
            [
                'title' => 'Data Importing',
                'description' => 'Seamlessly migrate your existing data from old systems into Gymivida\'s CMS — quick, secure, and hassle-free setup with no downtime.',
                'icon' => 'bi bi-cloud-upload',
                'order' => 12,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
