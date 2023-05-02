<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Category;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeachingController extends Controller
{
    // direct teaching page
    public function teachingPage(){
        $categories = Category::where('professor_id',Auth::user()->id)->paginate(2);
        $courses = Course::where('professor_id',Auth::user()->id)->paginate(2);
        $assignments = Assignment::select('assignments.*','courses.course_title','users.name')
                ->join('courses','assignments.course_id','courses.course_id')
                ->join('users','assignments.student_id','users.id')
                ->where('courses.professor_id',Auth::user()->id)
                ->where('assignments.assignment_status',"pending")
                ->orderBy('assignments.course_id','asc')
                ->paginate(5);

        return view('admin.teaching.teaching',compact('categories','courses','assignments'));
    }

    // assignment submission
    public function assignmentSubmission($assignmentId, Request $request){

        Assignment::where('assignment_id',$assignmentId)->update(['assignment_status' => $request->assignmentStatus]);

        return back()->with('statusChange',"You have checked one assignment.");
    }
}
