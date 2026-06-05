<?php

namespace App\Filament\Resources\Vehicles\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;

class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label('Main image')
                    ->image()
                    ->directory('vehicles/main')
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpanFull(),

                Repeater::make('images')
                    ->label('Detail images')
                    ->relationship('images')
                    ->schema([
                        FileUpload::make('path')
                            ->label('Image')
                            ->image()
                            ->directory('vehicles/details')
                            ->disk('public')
                            ->visibility('public')
                            ->required(),

                        TextInput::make('alt')
                            ->label('Alt text'),

                        TextInput::make('sort_order')
                            ->label('Sort order')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columnSpanFull()
                    ->collapsible()
                    ->addActionLabel('Add detail image'),

                Select::make('type')
                    ->options([
                        'bike' => 'Electric Bike',
                        'scooter' => 'Electric Scooter',
                        'moped' => 'Electric Moped',
                    ])
                    ->required(),

                TextInput::make('battery')
                    ->label('Battery'),

                TextInput::make('range_km')
                    ->label('Range (km)')
                    ->numeric()
                    ->required(),

                TextInput::make('price_per_hour')
                    ->label('Price per hour (€)')
                    ->numeric()
                    ->required(),

                TextInput::make('location')
                    ->required(),

                TextInput::make('speed_kmh')
                    ->label('Speed (km/h)')
                    ->numeric(),

                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
