<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Halls;

class HallsSeeder extends Seeder
{
    public function run(): void
    {
        $halls = [
            [
                'name_en' => 'Bowling Station',
                'name_ar' => 'صالة البولينغ',
            ],
            [
                'name_en' => 'Karting Station',
                'name_ar' => 'صالة الكارتينغ',
            ],
        ];

        foreach ($halls as $hall) {
            Halls::updateOrCreate(
                ['name_en' => $hall['name_en']], // prevent duplicates
                $hall
            );
        }
    }
}
