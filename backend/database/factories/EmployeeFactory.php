<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'l_name' => $this->faker->lastName,
            'f_name' => $this->faker->firstName,
            'm_name' => $this->faker->randomLetter,
            'age' => $this->faker->numberBetween(18, 24),
            'contact_number' => $this->faker->phoneNumber,
        ];
    }
}
