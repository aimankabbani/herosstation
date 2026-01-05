<?php

namespace App\Http\Services;

use App\Models\PhoneNumbers;
use Carbon\Carbon;

class PhoneNumberService
{

    public function create(array $data): PhoneNumbers
    {
        $countryCode = $data['country_code'] ?? '+963';
        $phone = preg_replace('/\D/', '', $data['phone']);

        if (str_starts_with($phone, ltrim($countryCode, '+'))) {
            $phone = substr($phone, strlen(ltrim($countryCode, '+')));
        }

        $fullNumber = $countryCode . $phone;

        $alreadyAddedToday = PhoneNumbers::where('phone', $fullNumber)
            ->where('hall_id', $data['hall_id'])
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if ($alreadyAddedToday) {
            throw new \Exception(__('phone.already_added_today'));
        }

        $record = PhoneNumbers::where('phone', $fullNumber)
            ->where('hall_id', $data['hall_id'])
            ->first();

        if ($record) {
            $record->update([
                'name' => $data['name'],
                'gender' => $data['gender'],
                'date_of_birth' => $data['dob'],
                'occurrence_count' => $record->occurrence_count + 1,
            ]);

            return $record;
        }

        return PhoneNumbers::create([
            'phone' => $fullNumber,
            'hall_id' => $data['hall_id'],
            'name' => $data['name'],
            'gender' => $data['gender'],
            'date_of_birth' => $data['dob'],
            'occurrence_count' => 1,
        ]);
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
