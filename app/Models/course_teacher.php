<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course_teacher extends Model
{
    use HasFactory;
    protected $fillable=[
        'teacher_id','course_id'
    ];



/*
my fk belongs to
*/

public function course(){
    return $this->belongsTo(course::class,'course_id');
}


public function teacher(){
    return $this->belongsTo(teacher::class,'teacher_id');
}
/*
who has my pk
 */
public function student_course_teacher(){
    return $this->hasMany(student_teacher_course::class);
}
}
