<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'role_id' => Role::customer()->first()->id,
            'name' => fake()->name(),
            'surname' => fake()->lastName,
            'birthdate' => fake()->dateTimeBetween('-70 year', '-18 year')->format('Y-m-d'),
            'phone' => fake()->unique()->e164PhoneNumber,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('qwerty1'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function admin(string $name = '', string $email = '')
    {
        return $this->state(function (array $attributes) use ($name, $email) {
            return [
                'role_id' => Role::admin()->first()->id,
                'name' => empty($name) ? fake()->name() : $name,
                'email' => empty($email) ? fake()->unique()->safeEmail() : $email
            ];
        });
    }
}
