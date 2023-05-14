<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IntroductionController extends Controller
{
    // direct home page
    public function home(){

        if(isset(Auth::user()->id) && Auth::user()->role == 'student'){
            return redirect()->route('student#dashboard');
        } elseif(isset(Auth::user()->id) && Auth::user()->role != 'student'){
            return redirect()->route('admin#dashboard');
        }

        $courses = Course::select('courses.*','users.name as professor_name','categories.title as category_title')
                ->join('users','courses.professor_id','users.id')
                ->join('categories','courses.category_id','categories.category_id')
                ->get();

        $courseRatings = Course::select('courses.course_id', DB::raw('AVG(enrolls.rating) as avgRating'))
                ->leftJoin('enrolls','courses.course_id','enrolls.course_id')
                ->groupBy('courses.course_id')
                ->get();

        return view('notLogIn.dashboard',compact('courses','courseRatings'));
    }
}

