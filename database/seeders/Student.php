<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Student;

class Students extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Student::factory()->count(10)->create();
    }
}
