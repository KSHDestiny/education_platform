<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Course;
use App\Models\Enroll;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    // direct student dashboard
    public function studentDashboard(){
        $courses = Course::select('courses.*','users.name as professor_name','categories.title as category_title')
                ->join('users','courses.professor_id','users.id')
                ->join('categories','courses.category_id','categories.category_id')
                ->get();

        $courseRatings = Course::select('courses.course_id', DB::raw('AVG(enrolls.rating) as avgRating'))
                        ->leftJoin('enrolls','courses.course_id','enrolls.course_id')
                        ->groupBy('courses.course_id')
                        ->get();

        // dd($courseRatings->toArray());

        $enrolls = Enroll::select('course_id','student_id')->where('student_id',Auth::user()->id)->get();

        return view('student.dashboard',compact('courses','enrolls','courseRatings'));
    }

    // direct student profile page
    public function profilePage(){
        return view('student.user.profile');
    }

    // edit profile
    public function profileEdit(Request $request){
        $this->studentValidation($request);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'age' => abs($request->age),
            'gender' => $request->gender,
            'phone' => $request->phone,
            'education' => $request->education,
            'updated_at' => Carbon::now()
        ];

        // update image file
        if($request->hasFile('profile')){
            // delete database image file
            $student = User::where('id',Auth::user()->id)->first();
            $dbImage = $student->profile;
            if($dbImage != null){
                Storage::delete(['public/students/'.$dbImage]);
            }

            // add image file
            $fileName = uniqid()."_".$request->profile->getClientOriginalName();
            $data['profile'] = $fileName;
            $request->profile->storeAs('public/students',$fileName);
        }

        User::where('id',Auth::user()->id)->update($data);
        return redirect()->route('student#dashboard')->with('successUpdate',"Your Profile is successfully updated.");
    }

    // change password
    public function changePassword(Request $request){
        $currentUserId = Auth::user()->id;
        $user = User::where('id',$currentUserId)->first();
        $dbPassword = $user->password;

        $this->passwordValidation($request);

        if(Hash::check($request->old_password,$dbPassword)){
            $data = ["password" => Hash::make($request->new_password)];
            User::where('id',$currentUserId)->update($data);
            return redirect()->route('student#dashboard');
        }

        return redirect()->route('student#profilePage')->with('passwordError',"The password must match old password.");
    }

    // student validation
    private function studentValidation($request){
        $validationRules = [
            'name' => 'required',
            'description' => 'required',
            'age' => 'max:2|gt:0',
            'gender' => 'required',
            'phone' => 'unique:users,phone,'.$request->id,
            'education' => 'required'
        ];

        Validator::make($request->all(),$validationRules,['age.max' => "Your age must not exceed 99 years",'age.gt' => "Age must be positive number."])->validate();
    }

    // password validation
    private function passwordValidation($request){
        $validationRules = [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required| same:new_password'
        ];

        Validator::make($request->all(),$validationRules)->validate();
    }
}
