<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdsResource\Pages\CreateAds;
use App\Filament\Resources\AdsResource\Pages\EditAds;
use App\Filament\Resources\AdsResource\Pages\ListAds;
use App\Models\Ads;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\TextColumn;

class AdsResource extends Resource
{
    protected static ?string $model = Ads::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Content';
    protected static ?string $navigationLabel = 'Ads';
    protected static ?string $pluralLabel = 'Ads';

    protected static ?string $recordTitleAttribute = 'image_url';

    public static function form(Form $form): Form
    {
        return $form->schema([

            FileUpload::make('image_url')
                ->label('Ad Image')
                ->image()
                ->directory('ads')
                ->disk('public')
                ->required()
                ->columnSpanFull(),

            Toggle::make('active')
                ->default(true)
                ->required(),

            TextInput::make('order')
                ->numeric()
                ->default(0)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order') // ⭐ drag & drop ordering
            ->defaultSort('order')
            ->columns([

                ImageColumn::make('image_url')
                    ->disk('public')
                    ->square()
                    ->size(80),

                ToggleColumn::make('active'),

                TextColumn::make('order')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->since(),
            ])
            ->filters([])
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
            'index' => ListAds::route('/'),
            'create' => CreateAds::route('/create'),
            'edit' => EditAds::route('/{record}/edit'),
        ];
    }
}
