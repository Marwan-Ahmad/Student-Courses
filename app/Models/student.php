<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','phone'
    ];
    /**
     who has Pk
     */
    public function student_teacher_course(){
        return $this->hasMany(student_teacher_course::class);
    }
}
