<?php

namespace App\Filament\Resources\Customers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Schema;

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        $columns = [
            TextColumn::make('company_name')
                ->searchable(),
            TextColumn::make('contact_person')
                ->searchable(),
            TextColumn::make('email')
                ->label('Email address')
                ->searchable(),
            TextColumn::make('phone')
                ->searchable(),
        ];

        if (Schema::hasColumn('customers', 'is_portal_active')) {
            $columns[] = IconColumn::make('is_portal_active')
                ->label('Portal Active')
                ->boolean();
        }

        if (Schema::hasColumn('customers', 'last_login_at')) {
            $columns[] = TextColumn::make('last_login_at')
                ->label('Last Portal Login')
                ->dateTime()
                ->sortable();
        }

        $columns[] = TextColumn::make('created_at')
            ->dateTime()
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true);

        $columns[] = TextColumn::make('updated_at')
            ->dateTime()
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true);

        return $table
            ->columns($columns)
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
