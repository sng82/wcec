<?php

namespace Database\Factories;

use App\Models\SubmissionDate;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubmissionDateFactory extends Factory
{
    protected $model = SubmissionDate::class;

    public function definition(): array
    {
        return [
            'admission_date' => $this->faker->dateTimeBetween('+4 weeks', '+52 weeks'),
            'updated_by' => 1,
        ];
    }
}
