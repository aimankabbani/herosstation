<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteResource\Pages;
use App\Filament\Resources\SiteResource\RelationManagers;
use App\Models\Site;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteResource extends Resource
{
    protected static ?string $model = Site::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('domain')->nullable(),
            Forms\Components\TextInput::make('path_prefix')->nullable(),
            Forms\Components\FileUpload::make('logo_path')->disk('public')->image()->imagePreviewHeight('80'),
            Forms\Components\FileUpload::make('favicon_path')->disk('public')->image()->imagePreviewHeight('32'),
            Forms\Components\ColorPicker::make('branding.primary_color')->label('Primary Color'),
            Forms\Components\Textarea::make('branding.custom_css')->label('Custom CSS')->rows(3),
            Forms\Components\TextInput::make('hero_title_ar')->label('Hero Title Arabic')->maxLength(255)->required(),
            Forms\Components\TextInput::make('hero_title_en')->label('Hero Title English')->maxLength(255)->required(),
            Forms\Components\TextInput::make('settings.phone_number')->label('Phone Number')->maxLength(20),
            Forms\Components\TextInput::make('slogan')
                ->label('Slogan')
                ->maxLength(255)
                ->required(),
            Forms\Components\Repeater::make('media')
                ->label('Media')
                ->relationship()
                ->schema([
                    Forms\Components\FileUpload::make('file_path')
                        ->disk('public')
                        ->image() // preview for images
                        ->acceptedFileTypes(['image/*', 'video/mp4', 'video/webm', 'video/ogg'])
                        ->imagePreviewHeight('80')
                        ->directory('media'),

                    Forms\Components\TextInput::make('alt')->label('Alt Text')->maxLength(255),

                    Forms\Components\Select::make('type')
                        ->options([
                            'image' => 'Image',
                            'video' => 'Video',
                        ])
                        ->required()
                        ->default('image')
                ])
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('slug'),
            Tables\Columns\TextColumn::make('domain'),
        ])->actions([
            Tables\Actions\EditAction::make(),
        ])->bulkActions([
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
            'index' => Pages\ListSites::route('/'),
            'create' => Pages\CreateSite::route('/create'),
            'edit' => Pages\EditSite::route('/{record}/edit'),
        ];
    }
}
