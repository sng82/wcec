<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['male', 'female']);
        $first_name = fake('en_GB')->firstName($gender);
        $last_name = fake('en_GB')->lastName();
        $email = (fake()->numberBetween(1,2) > 1 ? $first_name : $first_name[0])
                 . (fake()->numberBetween(1,3) > 1
                        ? fake()->randomElement(['','','','','-','_','.'])
                        : fake()->randomLetter()
                 )
                 . $last_name
                 . (fake()->numberBetween(1,3) > 1
                        ? fake()->randomElement(['','','','','','01','1','2','3'])
                        : fake()->numberBetween(1970,2006)
                 )
                 . '@example'
                 . fake()->randomElement([
                     '.co.uk','.co.uk','.co.uk','.co.uk',
                     '.com','.com','.com',
                     '.org',
                     '.org.uk'
                 ]);

        $mobile_phone_no = '07' . fake()->numberBetween(100000000,999999999);

        return [
//            'title' => fake()->title($gender),
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => strtolower($email),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'phone_main' => fake('en_GB')->phoneNumber(),
            'phone_mobile' => fake()->numberBetween(1,2) > 1 ? $mobile_phone_no : null,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
