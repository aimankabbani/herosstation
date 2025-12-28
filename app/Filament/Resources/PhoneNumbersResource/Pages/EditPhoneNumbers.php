<?php

namespace App\Filament\Resources\PhoneNumbersResource\Pages;

use App\Filament\Resources\PhoneNumbersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPhoneNumbers extends EditRecord
{
    protected static string $resource = PhoneNumbersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
