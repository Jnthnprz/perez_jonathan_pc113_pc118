<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

        protected $table = 'student';
    protected $fillable = [
        'l_name',
        'f_name',
        'm_name',
        'age',
        'contact_number',
    ];
}
