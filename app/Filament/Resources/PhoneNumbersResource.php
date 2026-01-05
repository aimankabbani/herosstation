<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhoneNumbersResource\Pages;
use App\Http\Services\UltraMsgService;
use App\Models\PhoneNumbers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\BulkAction;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;


class PhoneNumbersResource extends Resource
{
    protected static ?string $model = PhoneNumbers::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // ---------------- FORM ----------------
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Full Name')
                ->required()
                ->maxLength(255),

            Forms\Components\DatePicker::make('date_of_birth')
                ->label('Date of Birth')
                ->required(),

            Tables\Columns\TextColumn::make('gender')
                ->label(__('translate.gender'))
                ->sortable()
                ->formatStateUsing(fn($state) => $state === 'male' ? __('translate.male') : __('translate.female')),

            Forms\Components\TextInput::make('phone')
                ->label('Phone Number')
                ->required()
                ->tel(),

            Forms\Components\Select::make('hall_id')
                ->label('Hall')
                ->relationship('hall', 'name_ar')
                ->required(),

            Forms\Components\TextInput::make('occurrence_count')
                ->label('Occurrence')
                ->disabled(), // هذا الحقل يُحسب تلقائيًا
        ]);
    }

    // ---------------- TABLE ----------------
    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Full Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('gender')
                    ->label(__('translate.gender'))
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state === 'male' ? __('translate.male') : __('translate.female')),

                Tables\Columns\TextColumn::make('date_of_birth')
                    ->label('Date of Birth')
                    ->date(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone Number')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('hall.name_ar')
                    ->label('Hall')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('occurrence_count')
                    ->label('Occurrence')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Created')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('hall_id')
                    ->label('Hall')
                    ->relationship('hall', 'name_ar'),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                BulkAction::make('sendBulkMessage')
                    ->label('Send Bulk Message')
                    ->form([
                        Forms\Components\Textarea::make('message')
                            ->label('Message')
                            ->required()
                    ])
                    ->action(function (Collection $records, array $data) {
                        // $data => $data['message']
                        // dd($records[0]->phone,$data);
                        $ultraMsg = app(\App\Http\Services\UltraMsgService::class);

                        $ultraMsg->sendBulk($records, $data['message']);

                        Notification::make()
                            ->title('Bulk messages sent successfully!')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->icon('heroicon-o-envelope'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhoneNumbers::route('/'),
            // 'create' => Pages\CreatePhoneNumbers::route('/create'),
            // 'edit' => Pages\EditPhoneNumbers::route('/{record}/edit'),
        ];
    }
}
