<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use App\Models\User;
class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('name')
               ->label('User'),

               TextColumn::make('email')
               ->label('Email'),

               TextColumn::make('role')
               ->label('Role')
               ->badge()
               ->color(fn ($state)=> match ($state){
                'super_admin' => 'danger',
                'admin'=>'success',
                'kasir'=> 'info',
                default =>'gray',
               })

            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('role')
                ->label('By Role')
                ->options(User::pluck('role', 'id')->toArray()),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
