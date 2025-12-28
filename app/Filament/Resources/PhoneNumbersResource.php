<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhoneNumbersResource\Pages;
use App\Filament\Resources\PhoneNumbersResource\RelationManagers;
use App\Models\PhoneNumbers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PhoneNumbersResource extends Resource
{
    protected static ?string $model = PhoneNumbers::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('phone')
                ->required()
                ->tel(),

            Forms\Components\Select::make('hall_id')
                ->relationship('hall', 'name_ar')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone Number')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('hall.name_ar')
                    ->label('Hall')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('hall_id')
                    ->label('Hall')
                    ->relationship('hall', 'name_ar'),
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
            'index' => Pages\ListPhoneNumbers::route('/'),
            'create' => Pages\CreatePhoneNumbers::route('/create'),
            'edit' => Pages\EditPhoneNumbers::route('/{record}/edit'),
        ];
    }
}
