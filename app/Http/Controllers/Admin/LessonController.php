<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    // direct lesson page
    public function lessonPage($courseId){
        $course = Course::select("courses.*","users.name as professor_name","categories.title as category_title")
                ->join('users','courses.professor_id','users.id')
                ->join('categories','courses.category_id','categories.category_id')
                ->where('course_id',$courseId)->first();

        $lessons = Lesson::where('course_id',$courseId)->paginate(5);
        return view('admin.lesson.lesson',compact('course','lessons'));
    }

    // direct create & edit lesson Page
    public function lessonCreatePage($courseId, $professorId){
        $user = Auth::user();
        if($user->id != $professorId){
            abort(403);
        }

        $course = Course::where('course_id',$courseId)->first();
        $lessons = Lesson::where('course_id',$courseId)->get();
        return view('admin.lesson.createLesson',compact('course','lessons'));
    }

    // create, delete & edit lesson
    public function lessonCreate($courseId, Request $request){
        Lesson::where("course_id",$courseId)->delete();

        for($i=1; $i<200; $i++){
            if(!isset($request->data[$i]["lesson"])) continue;
            if(!isset($request->data[$i]["lessonDescription"])) continue;
            if(!isset($request->data[$i]["lessonLink"])) continue;

            $lesson = $request->data[$i]["lesson"];
            $lessonDescription = $request->data[$i]["lessonDescription"];
            $lessonLink = $request->data[$i]["lessonLink"];

            $data = [
                "course_id" => $courseId,
                "lesson" => $lesson,
                "lesson_description" => $lessonDescription,
                "lesson_link" => $lessonLink
            ];
            Lesson::create($data);
        }

        return redirect()->route('lesson#page',[$courseId])->with('updateSuccess',"CURRICULUM is successfully updated.");
    }

    // direct change lesson page
    public function lessonChangePage($lessonId){
        $lesson = Lesson::where('lesson_id',$lessonId)->first();
        return view('admin.lesson.changeLesson',compact('lesson'));
    }

    // change lesson
    public function lessonChange($lessonId, Request $request){
        $this->lessonValidation($request);

        $data = [
            'lesson_description' => $request->lessonDescription,
            'lesson_link' => $request->lessonLink,
            'updated_at' => Carbon::now()
        ];
        Lesson::where('lesson_id',$lessonId)->update($data);

        return redirect()->route('lesson#page',[$request->course_id])->with('editSuccess',"Lesson {$request->lesson} is successfully edited.");
    }

    // lesson validation
    private function lessonValidation($request){
        $validationRules = [
            'lessonDescription' => 'required',
            'lessonLink' => 'required'
        ];

        Validator::make($request->all(),$validationRules)->validate();
    }
}
