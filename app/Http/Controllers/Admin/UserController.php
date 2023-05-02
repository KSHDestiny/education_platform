<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // direct professor page
    public  function professorPage() {
        $founder = User::where("role","founder")->first();
        $professors = User::where("role","professor")->orderBy('created_at','asc')->paginate(4);
        return view('admin.dashboard',compact('founder','professors'));
    }

    // direct founder edit page
    public function founderEditPage(){
        $founder = User::where("role","founder")->first();
        return view('admin.user.editFounder',compact('founder'));
    }

    // founder edit
    public function founderEdit($id, Request $request){
        $this->founderValidation($request);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
            'gender' => $request->gender,
            'age' => $request->age,
            'phone' => $request->phone,
            'education' => $request->education,
            'updated_at' => Carbon::now()
        ];

        // update image file
        if($request->hasFile('profile')){
            // delete database image file
            $founder = User::where('id',$id)->first();
            $dbImage = $founder->profile;
            if($dbImage != null){
                Storage::delete(['public/'.$dbImage]);
            }

            // add image file
            $fileName = uniqid()."_".$request->profile->getClientOriginalName();
            $data["profile"] = $fileName;
            $request->profile->storeAs('public',$fileName);
        }
        User::where('id',$id)->update($data);
        return redirect()->route('admin#dashboard')->with('founderUpdate','Account is successfully updated.');
    }

    // create professor
    public function professorCreate(Request $request){
        $this->professorValidation($request, "create");
        $data = [
            'name' => $request->name,
            'role' => $request->role,
            'education' => $request->education,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'description' => $request->description
        ];
        User::create($data);
        return redirect()->route('admin#dashboard')->with('professorCreate',"Prof.{$request->name} has successfully joined in Education Platform.");
    }

    //direct professor edit page
    public function professorEditPage($id){

        $user = Auth::user();
        if ($user->id != $id) {
            abort(403);
        }

        $professor = User::where('id',$id)->first();
        return view('admin.user.editProfessor',compact('professor'));
    }

    // professor edit
    public function professorEdit($id, Request $request){

        $this->professorValidation($request, "edit");
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'age' => $request->age,
            'phone' => $request->phone,
            'education' => $request->education,
            'description' => $request->description,
            'updated_at' => Carbon::now()
        ];

        // update image file
        if($request->hasFile('profile')){
            // delete database image file
            $professor = User::where('id',$id)->first();
            $dbImage = $professor->profile;
            if($dbImage != null){
                Storage::delete(['public/'.$dbImage]);
            }

            // add image file
            $fileName = uniqid()."_".$request->profile->getClientOriginalName();
            $data["profile"] = $fileName;
            $request->profile->storeAs('public',$fileName);
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#dashboard')->with('professorUpdate','Account is successfully updated.');
    }

    // direct professor delete page
    public function professorDeletePage($id){

        if($id != 1){
            $user = Auth::user();
            if ($user->id != "1" && $user->id != $id) {
                abort(403);
            }
            $user = User::where('id',$id)->first();
            return view('admin.user.deleteProfessor',compact('user'));

        }else{
            abort(403);
        }
    }

    // professor delete
    public function professorDelete($id){

        // delete database image
        $professor = User::where('id',$id)->first();
        $dbImage = $professor->profile;
        if($dbImage != null){
            Storage::delete(['public/'.$dbImage]);
        }

        $professorName = User::select('name')->where('id',$id)->first();

        User::where('id',$id)->delete();

        return redirect()->route('admin#dashboard')->with('professorDelete',"Prof.{$professorName->name} has left from Education Platform.");
    }

    // direct profile page
    public function myProfile($id){
        $userData = User::where('id',$id)->first();
        return view('admin.user.profile',compact("userData"));
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
            return redirect()->route('admin#dashboard');
        }

        return redirect()->route('myProfile')->with('passwordError',"The password must match old password.");
    }

    // founder validation
    private function founderValidation($request){
        $validationRules = [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$request->id,
            'education' => 'required',
            'description' => 'required',
            'profile' => 'mimes:png,jpg,jpeg,webp|file'
        ];
        Validator::make($request->all(),$validationRules)->validate();
    }

    // professor validation
    private function professorValidation($request, $status){
        if($status == "create"){
            $validationRules = [
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'education' => 'required',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
                'description' => 'required',
            ];
        }elseif($status == "edit"){
            $validationRules = [
                'name' => 'required',
                'email' => 'required|unique:users,email,'.$request->id,
                'gender' => 'required',
                'education' => 'required',
                'description' => 'required',
                'profile' => 'mimes:png,jpg,jpeg,webp|file'
            ];
        }
        Validator::make($request->all(),$validationRules)->validate();
    }

    // change password validation
    private function passwordValidation($request){
        $passwordValidationRules = [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ];

        Validator::make($request->all(),$passwordValidationRules)->validate();
    }
}

