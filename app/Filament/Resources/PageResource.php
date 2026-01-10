<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\SiteResource\RelationManagers\ServicesRelationManager;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?string $label = 'Page';
    protected static ?string $pluralLabel = 'Pages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('site_id')
                    ->label('Site')
                    ->relationship('site', 'name_en')
                    ->searchable()
                    ->required(),

                Select::make('type')
                    ->label('Type')
                    ->options([
                        'home' => 'Home',
                        'about-us' => 'About Us',
                        'contact-us' => 'Contact Us',
                        'footer' => 'Footer',
                        'gallery' => 'Gallery',
                        'service' => 'Service',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('title_en')
                    ->label('Title (EN)')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('title_ar')
                    ->label('Title (AR)')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Forms\Components\RichEditor::make('content_en')
                    ->label('Content (EN)')
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('content_ar')
                    ->label('Content (AR)')
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('is_published')
                    ->label('Published')
                    ->default(true),

                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->label('Order'),

                Forms\Components\Hidden::make('type')->default('service'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('site.name_en')
                    ->label('Site')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('title_en')
                    ->label('Title (EN)')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('slug')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('type')
                    ->label('Type')
                    ->sortable()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'home' => 'Home',
                        'about-us' => 'About Us',
                        'contact-us' => 'Contact Us',
                        'footer' => 'Footer',
                        'gallery' => 'Gallery',
                        'service' => 'Service',
                        default => $state,
                    }),

                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),

                TextColumn::make('order')
                    ->sortable(),
            ])
            ->defaultSort('order')
            ->filters([
                SelectFilter::make('site_id')
                    ->label('Site')
                    ->relationship('site', 'name_en')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'home' => 'Home',
                        'about-us' => 'About Us',
                        'contact-us' => 'Contact Us',
                        'footer' => 'Footer',
                        'gallery' => 'Gallery',
                        'service' => 'Service',
                    ])
                    ->searchable(),

                TernaryFilter::make('is_published')
                    ->label('Published'),
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
            // ServicesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
