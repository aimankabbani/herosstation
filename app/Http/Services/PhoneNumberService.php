<?php

namespace App\Http\Services;

use App\Models\PhoneNumbers;
use Carbon\Carbon;

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

    public function loadReportData($filter, $page = 1, $count = 10)
    {
        $total = PhoneNumbers::count();
        $data = PhoneNumbers::with(['hall' => function ($query) {
            $query->select('id', 'name_en');
        }])
            ->select('phone', 'hall_id', 'created_at')
            ->orderBy('id', 'desc');


        if (!empty($filter['phone'])) {
            $data->where('phone', 'like', '%' . $filter['phone'] . '%');
        }

        if (!empty($filter['hall_id'])) {
            $data->where('hall_id', $filter['hall_id']);
        }

        // date_from
        // date_to
        if (!empty($filter['date_from']) && !empty($filter['date_to'])) {
            // Ensure dates are valid Carbon instances or properly formatted
            $from = Carbon::parse($filter['date_from'])->startOfDay();
            $to   = Carbon::parse($filter['date_to'])->endOfDay();

            $data->whereBetween('created_at', [$from, $to]);
        }

        $result = $data->forPage($page, $count)->get();

        return [
            'total' => $total,
            'data' => $result
        ];
    }
}
