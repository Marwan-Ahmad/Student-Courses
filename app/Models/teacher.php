<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','phone'
    ];

    /*
    my pk realeted to
    */
    public function course_teachers(){
        return $this->hasMany(course_teacher::class);
    }
}
