<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'l_name';
        'f_name';
        'm_name';
        'age';
        'contact_number';
    ]
}
