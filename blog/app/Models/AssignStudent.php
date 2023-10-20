<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\DiscountStudent;

class AssignStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'studentclass_id',
        'studentyear_id',
        'studentgroup_id',
        'studentshift_id',
    ];

    public function student(){
        return $this->belongsTo(User::class,'student_id','id');
    }

    public function studentclass(){
        return $this->belongsTo(StudentClass::class,'studentclass_id','id');
    }

    public function studentyear(){
        return $this->belongsTo(StudentYear::class,'studentyear_id','id');
    }

   /* public function discountstudent(){
        return $this->hasMany(DiscountStudent::class,'assign_student_id','id');
    }*/

    public function discountstudent(){        //AssignStudent model 'id'
        return $this->belongsTo(DiscountStudent::class,'id','assign_student_id'); 
                                                                 //DiscountStudent foreign key 'assign_student_id'
    }
}
