<?php

namespace App\Http\Services;

use App\Models\PhoneNumbers;

class PhoneNumberService
{

    public function create($data): PhoneNumbers
    {
        $phone = $data["phone"];
        $countryCode = $data["country_code"] ?? '+963';

        // Remove country code if the phone starts with it
        if (str_starts_with($phone, $countryCode)) {
            $phone = substr($phone, strlen($countryCode));
        }

        // Remove any non-numeric characters (optional, to clean spaces or dashes)
        $phone = preg_replace('/\D/', '', $phone);

        // Now $phone contains only the local number
        // Save full number optionally
        $fullNumber = $countryCode . $phone;

        return PhoneNumbers::updateOrCreate(
            [
                // Conditions to check for duplicates
                'phone' => $fullNumber,
                'hall_id' => $data['hall_id']
            ],
            [
                // Fields to update if it already exists
                'phone' => $fullNumber,
                'hall_id' => $data['hall_id']
            ]
        );
    }
}
