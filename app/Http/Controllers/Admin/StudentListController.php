<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentListController extends Controller
{
    // direct students' lists page
    public function studentListPage(){
        $students = User::where('role','student')->get();

        return view('admin.studentList.studentList',compact('students'));
    }
}
