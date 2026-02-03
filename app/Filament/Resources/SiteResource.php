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

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $label = 'Site';
    protected static ?string $pluralLabel = 'Sites';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Site')
                    ->tabs([

                        /* ======================
                           General
                        ======================= */
                        Forms\Components\Tabs\Tab::make('General')
                            ->schema([
                                Forms\Components\TextInput::make('name_en')
                                    ->label('Name (EN)')
                                    ->required(),

                                Forms\Components\TextInput::make('name_ar')
                                    ->label('Name (AR)')
                                    ->required(),

                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                Forms\Components\TextInput::make('domain')
                                    ->nullable(),

                                Forms\Components\TextInput::make('path_prefix')
                                    ->nullable(),
                            ]),

                        /* ======================
                           Branding
                        ======================= */
                        Forms\Components\Tabs\Tab::make('Branding')
                            ->schema([
                                Forms\Components\FileUpload::make('logo_path')
                                    ->disk('public')
                                    ->image()
                                    ->imagePreviewHeight(80),

                                Forms\Components\FileUpload::make('favicon_path')
                                    ->disk('public')
                                    ->image()
                                    ->imagePreviewHeight(32),

                                Forms\Components\ColorPicker::make('branding.primary_color')
                                    ->label('Primary Color'),

                                Forms\Components\Textarea::make('branding.custom_css')
                                    ->label('Custom CSS')
                                    ->rows(3),
                            ]),

                        /* ======================
                           Hero Section
                        ======================= */
                        Forms\Components\Tabs\Tab::make('Hero')
                            ->schema([
                                Forms\Components\TextInput::make('hero_title_en')
                                    ->label('Hero Title (EN)')
                                    ->required(),

                                Forms\Components\TextInput::make('hero_title_ar')
                                    ->label('Hero Title (AR)')
                                    ->required(),

                                Forms\Components\TextInput::make('slogan_en')
                                    ->label('Slogan (EN)')
                                    ->required(),

                                Forms\Components\TextInput::make('slogan_ar')
                                    ->label('Slogan (AR)')
                                    ->required(),

                                Forms\Components\FileUpload::make('hero_image_url')
                                    ->disk('public')
                                    ->image()
                                    ->directory('hero')
                                    ->label('Hero Image')
                                    ->maxSize(3072),
                            ]),

                        /* ======================
                           Settings
                        ======================= */
                        Forms\Components\Tabs\Tab::make('Settings')
                            ->schema([
                                Forms\Components\TextInput::make('settings.phone_number')
                                    ->label('Phone Number')
                                    ->tel(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_en')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->sortable(),

                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Phone'),

                Tables\Columns\ImageColumn::make('logo_path')
                    ->disk('public')
                    ->height(40),

                Tables\Columns\TextColumn::make('pages_count')
                    ->counts('pages')
                    ->label('Pages'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSites::route('/'),
            'create' => Pages\CreateSite::route('/create'),
            'edit' => Pages\EditSite::route('/{record}/edit'),
        ];
    }
}
