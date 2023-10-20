<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class StudentMarks extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'id_no',
        'year_id',
        'class_id',
        'assign_subject_id',
        'exam_type_id',
        'marks',
    ];

    public function student(){
        return $this->belongsTo(User::class,'student_id','id');
    }
}
