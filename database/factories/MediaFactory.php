<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    public function definition(): array
    {
        $type = $this->faker->randomElement(['image', 'video']);

        return [
            'file_path' => $type === 'image'
                ? 'https://picsum.photos/1600/900?random=' . rand(1, 99999)
                : 'https://samplelib.com/lib/preview/mp4/sample-5s.mp4',
            'type' => $type,
            'alt' => $this->faker->sentence(4),
        ];
    }
}
