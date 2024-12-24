<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use App\Models\Interfacing;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

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
                Forms\Components\TextInput::make('os_server')
                    ->label('OS Server')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ip_server')
                    ->label('IP Server')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('interfacing_id')
                    ->label('Interfacing')
                    ->relationship('interfacing', 'interfacing_name')
                    ->options(Interfacing::all()->pluck('interfacing_name', 'id'))
                    ->required(),
                Forms\Components\Toggle::make('is_client_new')
                    ->label('Is new client?'),
                Forms\Components\Toggle::make('is_cloud_server')
                    ->label('Is cloud server?'),
                Forms\Components\DateTimePicker::make('created_at')
                    ->label('Created At'),
                Forms\Components\Textarea::make('interface_notes')
                    ->label('Interface Notes'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client_name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_cloud_server')
                    ->label('Server type')
                    ->boolean()
                    ->sortable()
                    ->trueIcon('heroicon-o-cloud')
                    ->falseIcon('heroicon-o-server-stack'),
                Tables\Columns\IconColumn::make('is_client_new')
                    ->label('New Client')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ip_server')
                    ->label('IP Server')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('os_server')
                    ->label('OS Server')
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
                SelectFilter::make('is_client_new')
                    ->label('New Client')
                    ->options([
                        0 => 'Existing Client',
                        1 => 'New Client',
                    ]),
                SelectFilter::make('is_cloud_server')
                    ->label('Server type')
                    ->options([
                        0 => 'On premise',
                        1 => 'Cloud',
                    ]),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
