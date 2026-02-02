<?php

namespace App\Filament\Resources;

use App\Models\Menu;
use App\Models\Site;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\MenuResource\Pages;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

    protected static ?string $navigationLabel = 'Menus';

    protected static ?string $navigationGroup = 'Website';

    protected static ?int $navigationSort = 2;


    /*
    |--------------------------------------------------------------------------
    | FORM
    |--------------------------------------------------------------------------
    */

    public static function form(Form $form): Form
    {
        return $form->schema([

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
                ->placeholder('Global menu (all sites)')
                ->helperText('Leave empty for global menu'),


            /*
            |--------------------------------------------------------------------------
            | Titles
            |--------------------------------------------------------------------------
            */
            Forms\Components\TextInput::make('title_en')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('title_ar')
                ->required()
                ->maxLength(255),


            /*
            |--------------------------------------------------------------------------
            | Internal Page
            |--------------------------------------------------------------------------
            */
            Forms\Components\Select::make('page_id')
                ->label('Internal Page')
                ->relationship('page', 'title_en')
                ->searchable()
                ->preload()
                ->live()
                ->placeholder('Select a page')
                ->hidden(fn ($get) => filled($get('url')))
                ->helperText('Choose page OR external URL'),


            /*
            |--------------------------------------------------------------------------
            | External URL
            |--------------------------------------------------------------------------
            */
            Forms\Components\TextInput::make('url')
                ->label('External URL')
                ->url()
                ->live()
                ->placeholder('https://example.com')
                ->hidden(fn ($get) => filled($get('page_id')))
                ->helperText('Used only if no page selected'),


            /*
            |--------------------------------------------------------------------------
            | Order
            |--------------------------------------------------------------------------
            */
            Forms\Components\TextInput::make('order')
                ->numeric()
                ->default(0),


            /*
            |--------------------------------------------------------------------------
            | Active
            |--------------------------------------------------------------------------
            */
            Forms\Components\Toggle::make('active')
                ->default(true),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('order')
            ->reorderable('order') // 🔥 drag & drop
            ->columns([

                Tables\Columns\TextColumn::make('title_en')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title_ar'),

                Tables\Columns\TextColumn::make('site.name_en')
                    ->label('Site')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ?? 'Global')
                    ->color(fn ($state) => $state ? 'primary' : 'success'),

                Tables\Columns\TextColumn::make('page.title_en')
                    ->label('Page')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('url')
                    ->limit(30)
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('order')
                    ->sortable(),

                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
            ])


            /*
            |--------------------------------------------------------------------------
            | FILTERS
            |--------------------------------------------------------------------------
            */
            ->filters([

                SelectFilter::make('site_id')
                    ->label('Filter by Site')
                    ->options(Site::pluck('name_en', 'id')->toArray()),

                Filter::make('global')
                    ->label('Global Only')
                    ->query(fn ($q) => $q->whereNull('site_id')),
            ])


            /*
            |--------------------------------------------------------------------------
            | ACTIONS
            |--------------------------------------------------------------------------
            */
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public static function getRelations(): array
    {
        return [];
    }


    /*
    |--------------------------------------------------------------------------
    | PAGES
    |--------------------------------------------------------------------------
    */

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
