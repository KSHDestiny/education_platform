@extends('student.layouts.master')

@section('title')
    <title>{{ Auth::user()->name }}'s Profile Page</title>
@endsection

@section('nav-sm')
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('student#profilePage') }}">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student#enrolledCoursePage') }}">Courses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student#achievement') }}">Achievements</a>
        </li>
        <li class="nav-item">
            <a href=""><img src="" alt=""></a>
        </li>
        </ul>
        <div class="nav-item">
            <a href="{{ route('student#discussionPage') }}" title="Discussion" class="mt-3 border-0 bg-pale"><img src="{{ asset('asset3/css/images/messenger.png') }}" width="50px" alt=""></a>
            <a href="#" onclick="document.getElementById('myForm').submit(); return false;" title="Logout"><img src="{{ asset('asset3/css/images/logout.png') }}" class="image bg-pale" alt="" width="30px"></a>
        </div>
    </div>
@endsection

@section('nav')
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('student#profilePage') }}">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student#enrolledCoursePage') }}">Courses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student#achievement') }}">Achievements</a>
        </li>
        <li class="nav-item">
            <a href=""><img src="" alt=""></a>
        </li>
        </ul>
    </div>
@endsection


@section('content')

<div id="three">
    <section>
        <div class="mt-4">
            <h4>Edit Your Profile</h4>
            <form action="{{ route('student#profileEdit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    <div class="mb-3">
                        <label for="name" class="fa-fade h6 text-green">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name',Auth::user()->name) }}" placeholder="Enter your name ..." />
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="fa-fade h6 text-green">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone',Auth::user()->phone) }}" placeholder="Enter your phone number ..." />
                        @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="info" class="fa-fade h6 text-green">Your Information</label>
                        <textarea class="border-green form-control" name="description" id="info" cols="20" rows="3" placeholder="Enter your information ...">{{ old('description',Auth::user()->description) }}</textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="age" class="fa-fade h6 text-green">Age</label>
                        <input type="number" class="border-green form-control" name="age" class="border-green form-control" value="{{ old('age',Auth::user()->age) }}" id="age" placeholder="Enter your age ..." />
                        @error('age')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="fa-fade h6 text-green">Gender</label>
                        <select class="border-green form-control" name="gender" id="gender">
                            <option value="" selected disabled>Choose Gender</option>
                            <option value="male" @if (Auth::user()->gender == "male") selected @endif>Male</option>
                            <option value="female" @if (Auth::user()->gender == "female") selected @endif>Female</option>
                        </select>
                        @error('gender')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="education" class="fa-fade h6 text-green">Education</label>
                        <select class="border-green form-control" name="education" id="education">
                            <option value="" selected disabled>Choose Your Education</option>
                            <option value="ug" @if (Auth::user()->education == "ug") selected @endif>Undergraduate</option>
                            <option value="scnd" @if (Auth::user()->education == "scnd") selected @endif>Some college but no degree</option>
                            <option value="ad" @if (Auth::user()->education == "ad") selected @endif>Associate Degree</option>
                            <option value="bd" @if (Auth::user()->education == "bd") selected @endif>Bachelor's Degree</option>
                            <option value="md" @if (Auth::user()->education == "md") selected @endif>Master's Degree</option>
                        </select>
                        @error('education')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="profile" class="fa-fade h6 text-green">Profile</label>
                        <input type="file" class="border-green form-control" name="profile" class="bg-secondary form-control text-white" id="profile"  />
                        @error('profile')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <ul class="actions d-flex justify-content-between">
                    <li><a href="{{ route('student#dashboard') }}" class="btn">Cancel</a></li>
                    <li><input type="submit" value="Edit Profile" /></li>
                </ul>
            </form>
        </div>
        <hr>

            <div class="">
                <h4>Change Password</h4>
                <form action="{{ route('student#changePassword') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="old_password" class="fa-fade h6 text-green">Old Password</label>
                            <input type="password" class="border-green form-control" name="old_password" id="old_password" placeholder="Enter your old password ..." />
                            @error('old_password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        @if (session('passwordError'))
                            <p class="text-danger">{{ session('passwordError') }}</p>
                        @endif
                        <div class="mb-3">
                            <label for="new_password" class="fa-fade h6 text-green">New Password</label>
                            <input type="password" class="border-green form-control" name="new_password" id="new_password" placeholder="Enter your new password ..." />
                            @error('new_password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="fa-fade h6 text-green">Confirm Password</label>
                            <input type="password" class="border-green form-control" name="confirm_password" id="confirm_password" placeholder="Enter your confirm password ..." />
                            @error('confirm_password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <ul class="actions d-flex justify-content-between">
                        <li><a href="{{ route('student#dashboard') }}" class="btn">Cancel</a></li>
                        <li><input type="submit" value="Change Password" /></li>
                    </ul>
                </form>
            </div>
    </section>
</div>

@endsection
