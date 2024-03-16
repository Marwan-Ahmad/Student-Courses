<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_teacher_course extends Model
{
    use HasFactory;
    protected $fillable=[
        'course_teacher_id','student_id'
    ];
    /*
    Pk belongs to
     */
    public function student(){
        return $this->belongsTo(student::class,'student_id');

    }

    public function course_teachers(){
        return $this->belongsTo(course_teacher::class,'course_teacher_id');

    }
}
