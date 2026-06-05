<?php

namespace App\Filament\Resources\Vehicles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VehiclesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('range_km')
                    ->label('Range')
                    ->suffix(' km')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('price_per_hour')
                    ->label('Price / hour')
                    ->money('EUR')
                    ->sortable(),

                TextColumn::make('location')
                    ->label('Location')
                    ->searchable(),

                TextColumn::make('speed_kmh')
                    ->label('Speed')
                    ->suffix(' km/h')
                    ->numeric()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}