<?php

namespace App\Filament\Widgets;

use App\Models\ContactUs;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContactStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalContacts = ContactUs::count();
        $wantsRegistration = ContactUs::where('wants_registration_email', true)->count();
        $newContacts = ContactUs::where('status', 'new')->count();
        $registrationPercentage = $totalContacts > 0 
            ? round(($wantsRegistration / $totalContacts) * 100, 1) 
            : 0;

        return [
            Stat::make('Total Contacts', $totalContacts)
                ->description('All contact submissions')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5]),

            Stat::make('Wants Registration', $wantsRegistration)
                ->description("{$registrationPercentage}% of total contacts")
                ->descriptionIcon('heroicon-m-envelope')
                ->color('success')
                ->chart([3, 5, 2, 4, 3, 6, 4]),

            Stat::make('New Contacts', $newContacts)
                ->description('Pending review')
                ->descriptionIcon('heroicon-m-bell')
                ->color('warning')
                ->chart([5, 4, 3, 5, 4, 3, 6]),
        ];
    }
}
