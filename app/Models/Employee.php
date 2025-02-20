<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees'; // Dapat tama ang table name
    protected $fillable = [
        'l_name',
        'f_name',
        'm_name',
        'age',
        'contact_number',
    ];
}
