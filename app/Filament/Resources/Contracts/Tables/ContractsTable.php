<?php

namespace App\Filament\Resources\Contracts\Tables;

use App\Models\Contract;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components as FormComponents;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContractsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('contract_number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('project.name')
                    ->label('Project')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('customer.company_name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('contract_value')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                \Filament\Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'draft',
                        'warning' => 'sent',
                        'info' => 'signed',
                        'success' => 'active',
                        'success' => 'completed',
                        'danger' => 'terminated',
                    ]),
                TextColumn::make('signed_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // Sign Contract - Only when status is DRAFT
                Action::make('sign_contract')
                    ->label('Sign')
                    ->icon(Heroicon::OutlinedDocumentCheck)
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Sign Contract')
                    ->modalDescription('By signing this contract, it will become active.')
                    ->modalIcon(Heroicon::OutlinedPencilSquare)
                    ->visible(fn (Contract $record) => $record->status === Contract::STATUS_DRAFT)
                    ->form([
                        FormComponents\Textarea::make('notes')
                            ->label('Signature Notes')
                            ->placeholder('Add any notes about this contract signing...')
                            ->rows(2),
                    ])
                    ->action(function (Contract $record, array $data) {
                        // Update contract to ACTIVE
                        $record->update([
                            'status' => Contract::STATUS_ACTIVE,
                            'signed_at' => now(),
                        ]);
                        
                        // Auto-advance project to PLANNING if exists
                        if ($record->project && $record->project->status === 'awaiting_contract') {
                            $record->project->update([
                                'status' => 'planning',
                            ]);
                        }
                        
                        Notification::make()
                            ->title('Contract Signed')
                            ->success()
                            ->body('Contract signed successfully.')
                            ->send();
                    }),
                
                \Filament\Actions\EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
