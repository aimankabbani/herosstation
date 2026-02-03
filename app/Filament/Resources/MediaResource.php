<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;


class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $label = 'Media';
    protected static ?string $pluralLabel = 'Media';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('site_id')
                    ->relationship('site', 'name_en')
                    ->required()
                    ->searchable()
                    ->preload(),

                Forms\Components\Select::make('type')
                    ->options([
                        'image' => 'Image',
                        'video' => 'Video',
                    ])
                    ->required()
                    ->reactive(),

                FileUpload::make('file_path')
                    ->label('File')
                    ->disk('public')
                    ->directory('media')
                    ->visibility('public')
                    ->required()
                    ->acceptedFileTypes(
                        fn(callable $get) =>
                        $get('type') === 'video'
                            ? ['video/mp4', 'video/webm', 'video/ogg']
                            : ['image/jpeg', 'image/png', 'image/webp']
                    )
                    ->previewable()
                    ->openable()
                    ->maxSize(
                        fn(callable $get) =>
                        $get('type') === 'video' ? 51200 : 5120 // 50MB video, 5MB image
                    ),

                Forms\Components\TextInput::make('alt')
                    ->label('Alt Text')
                    ->maxLength(255)
                    ->visible(fn(callable $get) => $get('type') === 'image'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')
                    ->disk('public')
                    ->label('Preview')
                    ->height(60)
                    ->width(80)
                    ->extraAttributes(['style' => 'object-fit: cover;'])
                    ->defaultImageUrl('https://picsum.photos/80/60'),

                Tables\Columns\TextColumn::make('site.name_en')
                    ->label('Site'),

                Tables\Columns\TextColumn::make('type')
                    ->label('Type'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('site_id')
                    ->label('Site')
                    ->relationship('site', 'name_en') // assumes your Media model has site() relation
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->selectable(); // <<< This adds the checkboxes per row
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
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
        ];
    }
}
