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
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone_no' => fake()->unique()->phoneNumber(),
            'cnic' => fake()->unique()->numberBetween(),
            'email_verified_at' => now(),
            'password' =>  Hash::make('12345'),
            'profile_picture' =>  'default.png',
            'gender' =>  'Male',
            'dob' =>  fake()->date(),
            'address' =>  fake()->address(),
            'user_type' =>   'Student',
            'status' =>   1,
            'remember_token' => Str::random(10),
            'created_at' =>  now(),
            'updated_at' =>  now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
