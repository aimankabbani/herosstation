<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use App\Models\Site;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Resources\Resource;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $label = 'Page';
    protected static ?string $pluralLabel = 'Pages';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Site selector (nullable = global page)
            Select::make('site_id')
                ->label('Site')
                ->relationship('site', 'name_en')
                ->searchable()
                ->preload()
                ->placeholder('Global page (all sites)')
                ->helperText('Leave empty for a global page'),

            // Page type
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

            // Titles
            TextInput::make('title_en')
                ->label('Title (EN)')
                ->required()
                ->maxLength(255),

            TextInput::make('title_ar')
                ->label('Title (AR)')
                ->required()
                ->maxLength(255),

            // Slug
            TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),

            // Content
            Textarea::make('content_en')
                ->label('Content (EN)')
                ->columnSpanFull()
                ->extraAttributes(['class' => 'rich-editor'])
                ->hint('You can enter HTML + inline CSS here'),

            Textarea::make('content_ar')
                ->label('Content (AR)')
                ->columnSpanFull()
                ->extraAttributes(['class' => 'rich-editor'])
                ->hint('You can enter HTML + inline CSS here'),

            // Published toggle
            Toggle::make('is_published')
                ->label('Published')
                ->default(true),

            // Order
            TextInput::make('order')
                ->numeric()
                ->default(0)
                ->label('Order'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('order')
            ->columns([
                TextColumn::make('site.name_en')
                    ->label('Site')
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state ?? 'Global'),

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
            ->filters([
                SelectFilter::make('site_id')
                    ->label('Site')
                    ->options(function () {
                        return array_merge([null => 'Global'], Site::pluck('name_en', 'id')->toArray());
                    })
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
        return [];
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
