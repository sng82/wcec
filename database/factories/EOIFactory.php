<?php

namespace Database\Factories;

use App\Models\EOI;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EOIFactory extends Factory
{
    protected $model = EOI::class;

    public function definition(): array
    {
        return [
            'employment_history' => $this->faker->words(25, true),
            'current_role'       => $this->faker->words(25, true),
            'created_at'         => Carbon::now(),
            'training'           => $this->faker->words(25, true),
            'notes'              => $this->faker->words(25, true),
            'feedback'           => $this->faker->words(25, true),
            'updated_at'         => Carbon::now(),
            'submitted_at'       => Carbon::now(),
            'qualifications'     => $this->faker->words(25, true),

            'user_id' => 1,
        ];
    }
}
