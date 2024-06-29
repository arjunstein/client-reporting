<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use App\Models\Interfacing;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('client_name')
                    ->label('Client')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ip_server')
                    ->label('IP Server')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_client_new')
                    ->label('Is new client?'),
                Forms\Components\Select::make('interfacing_id')
                    ->label('Interfacing')
                    ->relationship('interfacing', 'interfacing_name')
                    ->options(Interfacing::all()->pluck('interfacing_name', 'id'))
                    ->required(),
                Forms\Components\DateTimePicker::make('created_at')
                    ->label('Created At')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client_name')
                    ->label('Client')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_client_new')
                    ->label('New Client')
                    ->boolean(),
                Tables\Columns\TextColumn::make('ip_server')
                    ->label('IP Server')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('interfacing.interfacing_name')
                    ->label('Interfacing')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'asc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
