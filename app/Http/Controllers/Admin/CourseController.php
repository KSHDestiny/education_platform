<?php

namespace App\Http\Controllers\Admin;

use App\Models\Chat;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    // direct course page
    public function coursePage(){
        $categories = Category::select('category_id','title','professor_id')->get();

        $courses = Course::select('courses.*','users.name as professor_name','categories.title as category_title')
                        ->join('users','courses.professor_id','users.id')
                        ->join('categories','courses.category_id','categories.category_id')
                        ->when(request('q'),function($query){
                            $key = request("q");

                            if(request("searchOption") == "all"){
                                $query->where('courses.course_title','like','%'.$key.'%')
                                    ->orWhere('categories.title','like','%'.$key.'%')
                                    ->orWhere('users.name','like','%'.$key.'%')
                                    ->orWhere('courses.difficulty','like','%'.$key.'%');
                            }elseif(request("searchOption") == "title"){
                                $query->where('courses.course_title','like','%'.$key.'%');
                            }elseif(request("searchOption") == "category"){
                                $query->where('categories.title','like','%'.$key.'%');
                            }elseif(request('searchOption') == "professor"){
                                $query->where('users.name','like','%'.$key.'%');
                            }elseif(request("searchOption") == "difficulty"){
                                $query->where('courses.difficulty','like','%'.$key.'%');
                            }
                        })->orderBy('course_id','asc')->paginate(3);

        return view('admin.course.course',compact('categories','courses'));
    }

    // course create
    public function courseCreate(Request $request){
        $this->courseValidation($request, "create");

        $data = [
            "category_id" => $request->categoryId,
            "professor_id" => $request->professorId,
            "course_title" => $request->courseTitle,
            "course_content" => $request->courseContent,
            "difficulty" => $request->difficulty,
            "assignment" => abs($request->assignment),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ];

        if($request->hasFile('courseImage')){
            $fileName = uniqid()."_".$request->courseImage->getClientOriginalName();
            $data["course_image"] = $fileName;
            $request->courseImage->storeAs('public/courseImages',$fileName);
        }

        $id = Course::insertGetId($data);
        Chat::create(['course_id'=>$id]);

        return redirect()->route('course#page')->with('createSuccess',"Course {$request->courseTitle} is successfully created.");
    }

    // course edit page
    public function courseEditPage($id){
        $categories = Category::select('category_id','title','professor_id')->get();
        $course = Course::where('course_id',$id)->first();

        $user = Auth::user();
        if($user->id != $course->professor_id){
            abort(403);
        }

        return view('admin.course.editCourse',compact('categories','course'));
    }

    // course edit
    public function courseEdit($id, Request $request){
        $this->courseValidation($request, "edit");
        $data = [
            "category_id" => $request->categoryId,
            "professor_id" => $request->professorId,
            "course_title" => $request->courseTitle,
            "course_content" => $request->courseContent,
            "difficulty" => $request->difficulty,
            "assignment" => abs($request->assignment),
            "updated_at" => Carbon::now(),
        ];

        // update image file
        if($request->hasFile('courseImage')){
            // delete database image file
            $course = Course::where('course_id',$id)->first();
            $dbImage = $course->course_image;
            if($dbImage != null){
                Storage::delete(['public/courseImages/'.$dbImage]);
            }

            // add image file
            $fileName = uniqid()."_".$request->courseImage->getClientOriginalName();
            $data["course_image"] = $fileName;
            $request->courseImage->storeAs('public/courseImages',$fileName);
        }

        Course::where('course_id',$id)->update($data);
        return redirect()->route('teaching#page')->with('editSuccess',"Course {$request->courseTitle} is successfully edited.");
    }

    // course delete page
    public function courseDeletePage($id){
        $course = Course::where('course_id',$id)->first();

        $user = Auth::user();
        if($user->id != $course->professor_id){
            abort(403);
        }

        return view('admin.course.deleteCourse',compact('course'));
    }

    // course delete
    public function courseDelete($id){
        $courseTitle = Course::select('course_title')->where('course_id',$id)->first();

        // delete database image
        $course = Course::where('course_id',$id)->first();
        $dbImage = $course->course_image;
        if($dbImage != null){
            Storage::delete(['public/courseImages/'.$dbImage]);
        }

        Course::where('course_id',$id)->delete();
        return redirect()->route('teaching#page')->with('deleteSuccess',"Course {$courseTitle->course_title} is successfully deleted.");
    }

    // course validation
    private function courseValidation($request, $status){
        if($status == "create"){
            $validationRules = [
                "categoryId" => 'required',
                "courseTitle" => 'required',
                "courseContent" => 'required',
                'courseImage' => 'required|mimes:png,jpg,jpeg,webp|file',
                "difficulty" => 'required',
                "assignment" => 'required| max:2| gt:0',
            ];
        }else{
            $validationRules = [
                "categoryId" => 'required',
                "courseTitle" => 'required',
                "courseContent" => 'required',
                'courseImage' => 'mimes:png,jpg,jpeg,webp|file',
                "difficulty" => 'required',
                "assignment" => 'required| max:2| gt:0',
            ];
        }

        Validator::make($request->all(),$validationRules,['categoryId.required' => "The category field is required.",'assignment.max'=>"The assignment must not be more than 99 assignments."])->validate();
    }
}
