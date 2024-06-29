<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SolvingResource\Pages;
use App\Filament\Resources\SolvingResource\RelationManagers;
use App\Models\Client;
use App\Models\DevelopedList;
use App\Models\Request;
use App\Models\Solving;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SolvingResource extends Resource
{
    protected static ?string $model = Solving::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('client_id')
                    ->relationship('client', 'client_name')
                    ->label('Client')
                    ->options(Client::clientsWithPendingRequests())
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('developed_id')
                    ->relationship('developed', 'item_name')
                    ->label('Developed')
                    ->options(DevelopedList::all()->pluck('item_name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('request_id')
                    ->relationship('request', 'issue')
                    ->label('Issue')
                    ->options(Request::all()->whereNotIn('status', 'Done')->pluck('issue', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\DatePicker::make('created_at')
                    ->label('Finish Date'),
                Forms\Components\Textarea::make('resolving')
                    ->label('How to resolve')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client.client_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('developed.item_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('request.issue')
                    ->label('Issue')
                    ->searchable()
                    ->limit(50)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->searchable()
                    ->dateTime()
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
            ->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListSolvings::route('/'),
            'create' => Pages\CreateSolving::route('/create'),
            'edit' => Pages\EditSolving::route('/{record}/edit'),
        ];
    }
}
