<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Models\Reservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Reservations';
    protected static ?string $pluralLabel = 'Reservations';
    protected static ?string $modelLabel = 'Reservation';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('User')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('site_id')
                    ->relationship('site', 'name')
                    ->label('Activity')
                    ->searchable()
                    ->required(),

                Forms\Components\DatePicker::make('date')
                    ->label('Date')
                    ->required(),

                Forms\Components\TimePicker::make('time')
                    ->label('Time')
                    ->required(),

                Forms\Components\Textarea::make('note')
                    ->label('Note')
                    ->rows(3),

                Forms\Components\TextInput::make('phone_number')
                    ->label('Phone Number')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('User')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('site.name_en')->label('Activity')
                    ->badge()->sortable()->searchable(),
                Tables\Columns\TextColumn::make('date')->date()->label('Date')->sortable(),
                Tables\Columns\TextColumn::make('time')->label('Time')->sortable(),
                Tables\Columns\TextColumn::make('note')->limit(30)->label('Note'),
                Tables\Columns\TextColumn::make('phone_number')->label('Phone'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Created At')->sortable(),
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
