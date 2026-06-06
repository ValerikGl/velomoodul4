<?php

namespace App\Filament\Widgets;

use App\Models\BlogPost;
use App\Models\Booking;
use App\Models\ContactMessage;
use App\Models\OfferBanner;
use App\Models\Vehicle;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Vehicles', Vehicle::count())
                ->description('Total vehicles')
                ->descriptionIcon('heroicon-m-truck')
                ->color('primary'),

            Stat::make('Bookings', Booking::count())
                ->description('All booking requests')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('success'),

            Stat::make('Contact Messages', ContactMessage::count())
                ->description('Messages from contact form')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('warning'),

            Stat::make('Blog Posts', BlogPost::count())
                ->description('Published and draft posts')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('info'),

            Stat::make('Offer Banners', OfferBanner::count())
                ->description('Homepage offer banners')
                ->descriptionIcon('heroicon-m-photo')
                ->color('primary'),
        ];
    }
}
