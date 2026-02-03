<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RatingResource\Pages;
use App\Filament\Resources\RatingResource\RelationManagers;
use App\Models\Rating;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Rating';
    protected static ?string $navigationGroup = 'Reports';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /*
            |--------------------------------------------------------------------------
            | Site (nullable = global)
            |--------------------------------------------------------------------------
            */
                Forms\Components\Select::make('site_id')
                    ->label('Site')
                    ->relationship('site', 'name_en')
                    ->searchable()
                    ->preload()
                    ->helperText('Leave empty for global menu'),

                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('User'),

                Select::make('stars')
                    ->label('Stars')
                    ->required()
                    ->options([
                        1 => '★',
                        2 => '★★',
                        3 => '★★★',
                        4 => '★★★★',
                        5 => '★★★★★',
                    ])
                    ->default(5),

                Forms\Components\Textarea::make('note')
                    ->label('Note')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('User')->sortable(),
                Tables\Columns\TextColumn::make('site.name_en')->label('Site')->badge()->sortable(),
                Tables\Columns\TextColumn::make('stars')
                    ->label('Stars')
                    ->formatStateUsing(fn($state) => str_repeat('★', $state)),
                Tables\Columns\TextColumn::make('note')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Created'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('site_id')
                    ->label('Site')
                    ->relationship('site', 'name_en'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListRatings::route('/'),
            'create' => Pages\CreateRating::route('/create'),
            'edit' => Pages\EditRating::route('/{record}/edit'),
        ];
    }
}
