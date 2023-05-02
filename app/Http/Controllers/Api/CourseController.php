<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use App\Models\Enroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // course sorting
    public function courseSorting(Request $request){
        if(isset($request->sorting) && empty($request->searchData)){
            $courses = Course::select('courses.*','users.name as professor_name','categories.title as category_title')
                    ->join('users','courses.professor_id','users.id')
                    ->join('categories','courses.category_id','categories.category_id')
                    ->orderBy('created_at',$request->sorting)->get();
        }
        elseif(empty($request->sorting) && isset($request->searchData)){
            $courses = Course::select('courses.*','users.name as professor_name','categories.title as category_title')
                        ->join('users','courses.professor_id','users.id')
                        ->join('categories','courses.category_id','categories.category_id')
                        ->when(request('searchData'),function($query){
                            $key = request("searchData");

                            $query->where('courses.course_title','like','%'.$key.'%')
                                    ->orWhere('categories.title','like','%'.$key.'%')
                                    ->orWhere('users.name','like','%'.$key.'%')
                                    ->orWhere('courses.difficulty','like','%'.$key.'%');
                        })
                        ->get();
        }
        elseif(isset($request->sorting) && isset($request->searchData)){
            $courses = Course::select('courses.*','users.name as professor_name','categories.title as category_title')
                    ->join('users','courses.professor_id','users.id')
                    ->join('categories','courses.category_id','categories.category_id')
                    ->when(request('searchData'),function($query){
                        $key = request("searchData");

                        $query->where('courses.course_title','like','%'.$key.'%')
                                ->orWhere('categories.title','like','%'.$key.'%')
                                ->orWhere('users.name','like','%'.$key.'%')
                                ->orWhere('courses.difficulty','like','%'.$key.'%');
                    })
                    ->orderBy('created_at',$request->sorting)->get();
        }
        else{
            $courses = Course::select('courses.*','users.name as professor_name','categories.title as category_title')
                    ->join('users','courses.professor_id','users.id')
                    ->join('categories','courses.category_id','categories.category_id')
                    ->orderBy('created_at','asc')->get();
        }

        $enrolls = Enroll::select('course_id','student_id')->where('student_id',$request->userId)->get();

        $courseRatings = Course::select('courses.course_id', DB::raw('AVG(enrolls.rating) as avgRating'))
                    ->leftJoin('enrolls','courses.course_id','enrolls.course_id')
                    ->groupBy('courses.course_id')
                    ->get();

        $data = [
            'courses' => $courses,
            'enrolls' => $enrolls,
            'courseRatings' => $courseRatings
        ];

        return response()->json($data, 200);
    }

}
