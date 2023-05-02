<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // direct dashboard
    public function dashboard(){
        $user = Auth::user();
        if($user && $user->role != "student"){
            return redirect()->route('admin#dashboard');
        }
        return redirect()->route('student#dashboard');
    }
}
