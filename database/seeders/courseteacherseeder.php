<?php

namespace Database\Seeders;

use App\Models\course_teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class courseteacherseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //course English
        course_teacher::query()->create([
            'teacher_id'=>1,
            'course_id'=>1
        ]);

        course_teacher::query()->create([
            'teacher_id'=>2,
            'course_id'=>1
        ]);
        /*******************************/
        // course franche
        course_teacher::query()->create([
            'teacher_id'=>3,
            'course_id'=>2
        ]);

        course_teacher::query()->create([
            'teacher_id'=>4,
            'course_id'=>2
        ]);
        /**********************/
        //course ICDL
        course_teacher::query()->create([
            'teacher_id'=>2,
            'course_id'=>3
        ]);
        /*****************************/

        //course communcation skills
        course_teacher::query()->create([
            'teacher_id'=>3,
            'course_id'=>4
        ]);
    }
}