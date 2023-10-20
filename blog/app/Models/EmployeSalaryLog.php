<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeSalaryLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'previous_salary',
        'present_salary',
        'increment_salary',
        'effected_date',
    ];

}
