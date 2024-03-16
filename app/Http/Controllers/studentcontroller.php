<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\course_teacher;
use App\Models\student;
use App\Models\student_teacher_course;
use App\Models\teacher;
use Illuminate\Http\Request;

class studentcontroller extends Controller
{
    public function store(Request $request){
        $request->validate([

            'name_student'=>['required','unique:students,name'],
            'phone'=>['required','digits:10'],
            'student_courses'=>['array','present'],
            'student_courses.*.teacher'=>'required',
            'student_courses.*.course'=>'required'
        ]);
        $student=student::query()->create([
            'name'=>$request->name_student,
            'phone'=>$request->phone
        ]);
        $student_couress=[];
      foreach($request['student_courses'] as $data){
        $teacher_name=$data['teacher'];
        $course_name=$data['course'];
        $teacher_check=teacher::query()->where('name','=',$teacher_name)->first();
        if(is_null($teacher_check)){
            $teacher_check= teacher::query()->create([
                'name'=>$teacher_name,
             ]);

        }



        $course_check=course::query()->where('title','=',$course_name)->first();
        if(is_null($course_check)){
           $course_check= course::query()->create([
                'title'=>$course_name
            ]);
        }

        //link teacher to course if not there are
        $courseteacher=course_teacher::query()->where('course_id','=',$course_check->id)
        ->where('teacher_id','=',$teacher_check->id)->first();
        if(is_null($courseteacher)){
           $courseteacher= course_teacher::query()->create([
                'teacher_id'=>$teacher_check->id,
                'course_id'=>$course_check->id
            ]);
        }

        //link student with the course
      $student_coures=student_teacher_course::query()->create([
            'course_teacher_id'=>$courseteacher->id,
            'student_id'=>$student->id,
        ]);
        $student_couress[]=student_teacher_course::query()
        ->with('student:id,name','course_teachers:id,course_id,teacher_id','course_teachers.course:id,title','course_teachers.teacher:id,name')
        ->find($student_coures->id);
      }


      return response()->json([
        'Data'=> $student_couress,
        'Massage'=>'student create with his chosen courses and teachers',
        'Status'=>201
    ]);
    }

    public function update(Request $request,$id){

        if(is_null($id)){
            return 'Please check out our id and try again';
        }
        $request->validate([

            'phone'=>['required','digits:10'],
            'student_courses'=>['array','present'],
            'student_courses.*.teacher'=>'required',
            'student_courses.*.course'=>'required'
        ]);

        $studentinfo=student::query()->find($id);
        $student_couress=[];
        $studentinfo->student_teacher_course()->delete();
      foreach($request['student_courses'] as $data){
        $teacher_name=$data['teacher'];
        $course_name=$data['course'];
        $teacher_check=teacher::query()->where('name','=',$teacher_name)->first();
        if(is_null($teacher_check)){
            $teacher_check= teacher::query()->create([
                'name'=>$teacher_name,
             ]);

        }



        $course_check=course::query()->where('title','=',$course_name)->first();
        if(is_null($course_check)){
           $course_check= course::query()->create([
                'title'=>$course_name
            ]);
        }

        //link teacher to course if not there are
        $courseteacher=course_teacher::query()->where('course_id','=',$course_check->id)
        ->where('teacher_id','=',$teacher_check->id)->first();
        if(is_null($courseteacher)){
           $courseteacher= course_teacher::query()->create([
                'teacher_id'=>$teacher_check->id,
                'course_id'=>$course_check->id
            ]);
        }

        //link student with the course
      $student_coures=student_teacher_course::query()->create([
            'course_teacher_id'=>$courseteacher->id,
            'student_id'=>$studentinfo->id,
        ]);
        $student_couress[]=student_teacher_course::query()
        ->with('student:id,name','course_teachers:id,course_id,teacher_id','course_teachers.course:id,title','course_teachers.teacher:id,name')
        ->find($student_coures->id);
      }


      return response()->json([
        'Data'=> $student_couress,
        'Massage'=>'student updated successfuly with his chosen courses and teachers',
        'Status'=>201
    ]);
    }


    public function showstudentcourses(){
         $allstudent=student::query()->get();
         $student_coursess=[];
         foreach($allstudent as $data){
            $student_coursess[]=student::query()
            ->with('student_teacher_course','student_teacher_course.student','student_teacher_course.course_teachers','student_teacher_course.course_teachers.course','student_teacher_course.course_teachers.teacher')
            ->find($data->id);
         }
         return response()->json([
            'Data'=>  $student_coursess,
            'Massage'=>'student showed successfuly with his chosen courses and teachers',
            'Status'=>201
        ]);
    }

}