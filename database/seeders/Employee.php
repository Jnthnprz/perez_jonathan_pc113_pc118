<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Employee;

class Employees extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Employee::factory()->count(10)->create();
    }
}
