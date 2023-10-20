<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentFeeAmount;
use App\Models\StudentClass;

class StudentFeeAmount extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_class_id',
        'student_fee_category_id',
        'amount',
    ];

    public function studentfeecategory(){
        return $this->belongsTo(StudentFeeCategory::class,'student_fee_category_id','id');
    }

    public function studentclass(){
        return $this->belongsTo(StudentClass::class,'student_class_id');
    }
}
