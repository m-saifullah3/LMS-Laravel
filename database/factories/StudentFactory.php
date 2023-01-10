<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=>rand(10,300),
            'basic_computer_knowledge'=> 1,
            'qualification'=> 'ICS',
            'occupation'=> 'NA',
            'created_at'=> now(),
            'updated_at'=> now(),
        ];
    }
}
