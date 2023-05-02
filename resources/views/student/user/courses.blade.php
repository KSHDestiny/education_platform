@extends('student.layouts.master')

@section('title')
    <title>Enrolled Courses' Page</title>
@endsection

@section('nav-sm')
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student#profilePage') }}">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('student#enrolledCoursePage') }}">Courses</a>
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
            <a class="nav-link" href="{{ route('student#profilePage') }}">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('student#enrolledCoursePage') }}">Courses</a>
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
    <h4 class="text-center my-3 text-secondary">My Current Studying Courses</h4>
    <hr>
    @if (count($enrolledCourses) < 1)
        <h4 class="text-green text-center fa-beat-fade mt-5">There is no enrolled Courses. Go and take some courses.</h4>
    @else
        @foreach ($enrolledCourses as $enrolledCourse)
            <div class="row mb-3">
                <div class="col-lg-5 col-md-5 col-sm-12 my-auto">
                    <a href="{{ route('student#courseLessonPage',[$enrolledCourse->enroll_id]) }}"><img src="{{ asset('storage/courseImages/'.$enrolledCourse->course_image) }}" alt="" width="100%"></a>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 bg-light">
                    <h6 class="text-green">{{ $enrolledCourse->course_title }}</h6>
                    <p class="text-secondary">{{ $enrolledCourse->course_content }}</p>
                    <span class="@if ($enrolledCourse->difficulty == "beginner")
                        text-success
                    @elseif ($enrolledCourse->difficulty == "intermediate")
                        text-warning
                    @else
                        text-danger
                    @endif">{{ $enrolledCourse->difficulty }}</span>
                    <div class="float-end">
                        <small>Instructed By -</small><b> Prof.{{ $enrolledCourse->professor_name }}</b>
                    </div>
                </div>
            </div>

            <hr>
        @endforeach
    @endif
</div>

@endsection
