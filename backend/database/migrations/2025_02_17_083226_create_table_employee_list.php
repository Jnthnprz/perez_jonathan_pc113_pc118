<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('l_name');
            $table->string('f_name');
            $table->string('m_name')->nullable();
            $table->string('email')->unique();
            $table->string('password') ->default(bcrypt('password'));
            $table->integer('age');
            $table->string('contact_number');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('table_employee_list');
    }
};
