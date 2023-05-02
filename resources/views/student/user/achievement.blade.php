@extends('student.layouts.master')

@section('title')
    <title>Achievement' Page</title>
@endsection

@section('nav-sm')
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student#profilePage') }}">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student#enrolledCoursePage') }}">Courses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('student#achievement') }}">Achievements</a>
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
            <a class="nav-link" href="{{ route('student#profilePage') }}">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student#enrolledCoursePage') }}">Courses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('student#achievement') }}">Achievements</a>
        </li>
        <li class="nav-item">
            <a href=""><img src="" alt=""></a>
        </li>
        </ul>
    </div>
@endsection


@section('content')

<div id="three">
    @if (session('Congrate'))
        <h5 class="text-success text-center fa-bounce">{{ session('Congrate') }}</h5>
    @endif
    <h4 class="text-center mt-3 mb-5 text-secondary">My Qualified Certifications</h4>
    @if (count($achievements) < 1)
        <h4 class="text-warning text-center fa-beat-fade mt-5">There is no certifications.</h4>
    @else
        @foreach ($achievements as $achievement)
            <div class="row mb-3">
                <div class="col-6">
                    <a href="{{ route('student#achievementCourse',[$achievement->course_id]) }}"><img src="{{ asset('storage/courseImages/'.$achievement->course_image) }}" alt="" width="100%"></a>
                </div>
                <div class="col-6 my-auto">
                    <h5 class="text-green">Course Title - {{ $achievement->course_title }}</h5>
                    <p>Course Instructor - <b>{{ $achievement->professor_name }}</b></p>
                    <p>Difficulty - <b>{{ $achievement->difficulty }}</b></p>
                    <p>Certified at - <b>{{ Carbon\Carbon::parse($achievement->certified_at)->format('F jS, o') }}</b></p>
                </div>
            </div>
            <hr>
        @endforeach
    @endif
</div>

@endsection
