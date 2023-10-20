<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentClass;
use App\Models\Subject;

class AssignSubject extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_class_id',
        'subject_id',
        'full_mark',
        'pass_mark',
        'get_mark',
    ];

    public function studentclass(){
        return $this->belongsTo(StudentClass::class,'student_class_id','id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
}
