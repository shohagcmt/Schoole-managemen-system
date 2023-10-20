<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\EmployeeLeavePurpose;

class EmployeeLeave extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'leave_purpose_id',
        'start_date',
        'end_date',
    ];

    public function employee(){
        return $this->belongsTo(User::class,'employee_id','id');
    }
    public function employee_leave_purpose(){
        return $this->belongsTo(EmployeeLeavePurpose::class,'leave_purpose_id','id');
    }
}
