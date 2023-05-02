<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Enroll;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Certification;

class StudentListController extends Controller
{
    // student list
    public function studentList(Request $request){
        $students = User::where('role','student')->get();

        logger($request);

        if($request->option == "all" && $request->key == null){
            $students = User::select('id','name','email','phone')->where('role','student')->get();
        }
        elseif ($request->option == "myStudents" && $request->key == null)
        {
            $students = Enroll::select('users.id','users.name','users.email','users.phone')
                        ->join('courses','enrolls.course_id','courses.course_id')
                        ->join('users','enrolls.student_id','users.id')
                        ->where('users.role','student')
                        ->where('courses.professor_id',$request->professorId)
                        ->distinct()
                        ->get();
        }
        elseif ($request->option == "all" && $request->key != null)
        {
            $students = User::select('id','name','email','phone')
                    ->where('role','student')
                    ->when(request('key'),function($query){
                        $key = request("key");
                        $query->where(function ($query) use ($key) {
                            $query->where('name', 'like', '%'.$key.'%')
                                  ->orWhere('email', 'like', '%'.$key.'%')
                                  ->orWhere('phone', 'like', '%'.$key.'%');
                        });
                    })
                    ->get();
        }
        elseif ($request->option == "myStudents" && $request->key != null)
        {
            $students = Enroll::select('users.id','users.name','users.email','users.phone')
            ->join('courses','enrolls.course_id','courses.course_id')
            ->join('users','enrolls.student_id','users.id')
            ->when(request("key"),function($query){
                $key = request("key");
                $query->where(function ($query) use ($key) {
                    $query->where('users.name','like','%'.$key.'%')
                        ->orWhere('users.email','like','%'.$key.'%')
                        ->orWhere('users.phone','like','%'.$key.'%');
                });
            })
            ->where('users.role','student')
            ->where('courses.professor_id',$request->professorId)
            ->distinct()
            ->get();
        }

        // logger($students);

        $data = [
            'students' => $students,
        ];

        return response()->json($data, 200);
    }

    // student detail
    public function studentDetail(Request $request){
        $studentDetail = User::where('users.id',$request->studentId)->first();

        $courses = Enroll::select('enrolls.course_id','courses.course_title')
                ->join('courses','enrolls.course_id','courses.course_id')
                ->where('enrolls.student_id',$request->studentId)
                ->get();

        $certifiedCourses = Certification::select('certifications.course_id','courses.course_title')
                ->join('courses','certifications.course_id','courses.course_id')
                ->where('certifications.student_id',$request->studentId)
                ->get();

        $details = [
            'studentDetail' => $studentDetail,
            'courses' => $courses,
            'certifiedCourses' => $certifiedCourses
        ];

        return response()->json($details,200);
    }
}
