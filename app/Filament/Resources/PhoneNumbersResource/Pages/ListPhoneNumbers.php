<?php

namespace App\Filament\Resources\PhoneNumbersResource\Pages;

use App\Filament\Resources\PhoneNumbersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPhoneNumbers extends ListRecords
{
    protected static string $resource = PhoneNumbersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
