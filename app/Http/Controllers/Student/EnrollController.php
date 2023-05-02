<?php

namespace App\Http\Controllers\Student;

use App\Models\Course;
use App\Models\Enroll;
use App\Models\Lesson;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\Certification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EnrollController extends Controller
{
    // enroll course
    public function enroll($courseId){
        $course = Course::select('course_title','enrolled_students')->where('course_id',$courseId)->first();
        $data = [
            'course_id' => $courseId,
            'student_id' => Auth::user()->id
        ];
        Enroll::create($data);

        $enrolledStudents = [
            'enrolled_students' => $course->enrolled_students + 1
        ];
        Course::where('course_id',$courseId)->update($enrolledStudents);

        return back()->with('enrollSuccess',"You have successfully enrolled {$course->course_title} Course.");
    }

    // direct enrolled course page
    public function enrolledCoursePage(){
        $enrolledCourses = Course::select('courses.*','users.name as professor_name','categories.title as category_title','enrolls.*')
                    ->join('users','courses.professor_id','users.id')
                    ->join('categories','courses.category_id','categories.category_id')
                    ->rightJoin('enrolls','courses.course_id','enrolls.course_id')
                    ->where('enrolls.student_id',Auth::user()->id)
                    ->where('enrolls.complete',false)
                    ->get();

        // dd($enrolledCourses->toArray());
        return view('student.user.courses',compact('enrolledCourses'));
    }

    // direct enrolled course lesson page
    public function courseLessonPage($enrollId){

        $lessons = Lesson::select('lessons.*')
                    ->join('enrolls','lessons.course_id','enrolls.course_id')
                    ->where('enrolls.enroll_id',$enrollId)->paginate(5);

        $course = Course::select('courses.course_id','courses.course_title','courses.assignment','enrolls.enroll_id','enrolls.rating')
                    ->join('enrolls','courses.course_id','enrolls.course_id')
                    ->where('enrolls.enroll_id',$enrollId)->first();

        $enroll = Enroll::where('enroll_id',$enrollId)->first();
        $enrollStudentId = $enroll->student_id;
        $enrollCourseId = $enroll->course_id;

        if($enrollStudentId != Auth::user()->id){
            abort(403);
        }

        $assignments = Assignment::where('student_id',Auth::user()->id)->where('course_id',$enrollCourseId)->get();

        $passAssignments = Assignment::where('student_id',Auth::user()->id)
                    ->where('course_id',$enrollCourseId)
                    ->where('assignment_status',"pass")
                    ->get()->count();

        $certificateCourse = strtolower($course->course_title);
        $certificateCourse = str_replace(' ', '', $certificateCourse);
        $certificateCourse = str_replace(',', '', $certificateCourse);

        // create Certification in certification table
        if ($course->assignment == $passAssignments){
            $courseTitle = $course->course_title;
            $data = [
                'course_id' => $enrollCourseId,
                'student_id' => $enrollStudentId,
                'certificate_code' => $certificateCourse . "_" . rand(0,999999999999999),
            ];
            Certification::create($data);

            // update complete to true in enroll table
            Enroll::where('enroll_id',$enrollId)->update(['complete'=>true]);

            return redirect()->route('student#achievement')->with('Congrate',"Congratulations! You have completed {$courseTitle}!");
        }

        return view('student.user.lessons',compact('lessons','course','assignments','passAssignments'));
    }

    // rating
    public function rating($enrollId, Request $request){
        Enroll::where('enroll_id',$enrollId)->update(['rating' => $request->rating]);
        return back();
    }

    // re rating
    public function reRating($enrollId, Request $request){
        Enroll::where('enroll_id',$enrollId)->update(['rating' => null]);
        return back();
    }

    // assignment submission
    public function courseAssignment($courseId, Request $request){
        // assignment submission validation
        Validator::make($request->all(),['assignmentLink'=>'required'])->validate();

        $data = [
            'course_id' => $courseId,
            'student_id' => Auth::user()->id,
            'assignment_no' => $request->assignmentNo,
            'assignment_link' => $request->assignmentLink,
            'submission' => true,
        ];

        Assignment::create($data);
        return back()->with('submissionSuccess',"You have submitted one assignment.");
    }

    // assignment resubmit
    public function assignmentResubmit($assignmentId){
        Assignment::where('assignment_id',$assignmentId)->delete();
        return back()->with('resubmitPermitted',"You can now resubmit your last assignment. Good Luck!");
    }

    // achievement
    public function achievement(){
        $achievements = Course::select('courses.*','certifications.*','users.name as professor_name','certifications.created_at as certified_at')
                ->join('certifications','courses.course_id','certifications.course_id')
                ->join('users','courses.professor_id','users.id')
                ->where('certifications.student_id',Auth::user()->id)
                ->get();
        return view('student.user.achievement',compact('achievements'));
    }

    // achievement course page
    public function achievementCourse($courseId){

        $lessons = Lesson::where('course_id',$courseId)->paginate(5);
        $course = Course::select('course_title')->where('course_id',$courseId)->first();
        $enroll = Enroll::select('rating','enroll_id')->where('course_id',$courseId)->where('student_id',Auth::user()->id)->first();

        return view('student.user.achievementCourse',compact('lessons','course','enroll'));
    }

    // rate course

}
