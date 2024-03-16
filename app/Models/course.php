<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;
    protected $fillable=[
        'title'
    ];
    /*
        my Pk realated to
     */
    public function course_teachers(){
        return $this->hasMany(course_teacher::class);
    }
}
