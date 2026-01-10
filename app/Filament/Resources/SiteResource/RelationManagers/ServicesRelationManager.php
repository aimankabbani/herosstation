<?php

namespace App\Filament\Resources\SiteResource\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table; 


class ServicesRelationManager extends RelationManager
{
    protected static string $relationship = 'services';
    protected static ?string $recordTitleAttribute = 'title_en';

    // Form for creating/editing a service
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title_en')
                    ->label('Title (EN)')
                    ->required()
                    ->maxLength(255),

                TextInput::make('title_ar')
                    ->label('Title (AR)')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Textarea::make('content_en')
                    ->label('Content (EN)'),

                Textarea::make('content_ar')
                    ->label('Content (AR)'),

                Toggle::make('is_published')
                    ->label('Published')
                    ->default(true),

                TextInput::make('order')
                    ->label('Order')
                    ->numeric()
                    ->default(0),

                Hidden::make('type')->default('service'), // Always service
            ]);
    }

    // Table for listing services
    public  function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title_en')->label('Title (EN)')->sortable(),
                TextColumn::make('title_ar')->label('Title (AR)')->sortable(),
                TextColumn::make('order')->sortable(),
                IconColumn::make('is_published')->boolean()->label('Published'),
            ])
            ->filters([
                TernaryFilter::make('is_published')->label('Published'),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
