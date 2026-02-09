<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema //form crud user
            ->components([
                TextInput::make('name')
                    ->label('User')
                    ->required(),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->regex('/^[\w\.\-]+@(gmail\.com|yahoo\.com)$/') //supaya mencegah domain lain yang tidak valid misal @ziyyan.com karena kalau cuma pakai 
                    ->validationMessages([                         //->email()  cuma mastiin mengandung '@' doang, gak cek domain
                        'regex' => 'Email hanya boleh menggunakan gmail.com atau yahoo.com',
                    ])
                    ->required(),

                    TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->dehydrateStateUsing(fn($state) => bcrypt ($state))
                    ->required(),

                    Select::make('role')
                    ->label('Role')
                    ->options([
                        'super_admin' =>'Super Admin',
                        'admin'=> 'Admin',
                        'kasir' => 'kasir',
                    ])
                    ->default('admin')
                    ->required(),
            ]);
    }
}
