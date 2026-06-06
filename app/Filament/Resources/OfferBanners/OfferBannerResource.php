<?php

namespace App\Filament\Resources\OfferBanners;

use App\Filament\Resources\OfferBanners\Pages\CreateOfferBanner;
use App\Filament\Resources\OfferBanners\Pages\EditOfferBanner;
use App\Filament\Resources\OfferBanners\Pages\ListOfferBanners;
use App\Filament\Resources\OfferBanners\Schemas\OfferBannerForm;
use App\Filament\Resources\OfferBanners\Tables\OfferBannersTable;
use App\Models\OfferBanner;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OfferBannerResource extends Resource
{
    protected static ?string $model = OfferBanner::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return OfferBannerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OfferBannersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOfferBanners::route('/'),
            'create' => CreateOfferBanner::route('/create'),
            'edit' => EditOfferBanner::route('/{record}/edit'),
        ];
    }
}
