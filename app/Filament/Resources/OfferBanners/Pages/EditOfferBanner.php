<?php

namespace App\Filament\Resources\OfferBanners\Pages;

use App\Filament\Resources\OfferBanners\OfferBannerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOfferBanner extends EditRecord
{
    protected static string $resource = OfferBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
