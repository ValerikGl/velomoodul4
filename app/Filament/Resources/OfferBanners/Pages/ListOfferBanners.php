<?php

namespace App\Filament\Resources\OfferBanners\Pages;

use App\Filament\Resources\OfferBanners\OfferBannerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOfferBanners extends ListRecords
{
    protected static string $resource = OfferBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
