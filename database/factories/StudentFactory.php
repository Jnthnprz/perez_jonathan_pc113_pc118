<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'l_name' => $this->faker->lastname,
            'f_name'=> $this->faker->firstname,
            'm_name'=> $this->faker->middlename,
            'age'=> $this->faker->numberBetween(18, 24),
            'contact_number'=> $this->faker->contactnumber,
        ];
    }
}
