@extends('admin.layouts.master')

@section('title')
    <title>Teaching Page</title>
    <style>
        .img-width{
            width: 500px;
        }

        @media(max-width: 736px){
            .img-width{
                width: 250px;
            }
        }
    </style>
@endsection

@section('header')
    <header id="header">
        <a href="#" class="logo">Education Platform</a>
        <h3 class="mt-3">Teachings</h3>
    </header>
@endsection

@section('navbar')
    <ul class="links">
        <li><a href="{{ route('admin#dashboard') }}">Professors</a></li>
        <li><a href="{{ route('category#page') }}">Categories</a></li>
        <li><a href="{{ route('course#page') }}">Courses</a></li>
        <li class="active"><a href="{{ route('teaching#page') }}">Teachings</a></li>
        <li><a href="{{ route('admin#studentListpage') }}">Students' Lists</a></li>
    </ul>
@endsection

@section('body')
    <div id="footer">
        <section>
            @if (session('editSuccess'))
                <h6 class="text-warning text-center fs-6">{{ session('editSuccess') }}</h6>
            @endif
            @if (session('deleteSuccess'))
                <h6 class="text-danger text-center fs-6">{{ session('deleteSuccess') }}</h6>
            @endif
            {{-- Categories --}}
            <div class="mb-5">
                <h5 class="mb-3 text-success">My Categories</h5>
                @foreach ($categories as $category)
                    <div class="d-flex justify-content-between">
                        <h6 class="text-primary"><i class="fa-solid fa-circle-dot fa-bounce fa-2xs pe-2"></i> {{ $category->title }}</h6>
                        <div>
                            <span class="@if (Auth::user()->id != $category->professor_id) d-none @endif">
                                <a href="{{ route('category#editPage',[$category->category_id]) }}" class="image" title="Edit">
                                    <i class="fa-regular fa-pen-to-square fs-5 ms-2 text-primary"></i>
                                </a>
                            </span>
                            <span class="@if (Auth::user()->id != $category->professor_id) d-none @endif">
                                <a href="{{ route('catagory#deletePage',[$category->category_id]) }}" class="image" title="Delete">
                                    <i class="fa-solid fa-trash-can fs-5 ms-2 text-danger"></i>
                                </a>
                            </span>
                        </div>
                    </div>
                    <p class="text-black">{{ $category->content }}</p>
                @endforeach
                <p>
                    {{ $categories->links() }}
                </p>
            </div>
            <hr>
            {{-- Courses --}}
            <div class="mb-5">
                <h5 class="mb-3 text-success">My Courses</h5>
                @foreach ($courses as $course)
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('lesson#page',[$course->course_id]) }}" class="text-decoration-none image" title="@if (Auth::user()->id == $course->professor_id)
                            Click to manage course
                        @else
                            Click for more details
                        @endif">
                            <h6 class="text-info">
                                <i class="fa-solid fa-circle-dot fa-bounce fa-2xs pe-2"></i>
                                {{ $course->course_title }}
                            </h6>
                        </a>
                        <div>
                            <span class="@if (Auth::user()->id != $course->professor_id) d-none @endif"><a href="{{ route('course#editPage',[$course->course_id]) }}" class="image" title="Edit"><i class="fa-regular fa-pen-to-square fs-5 ms-2 text-primary"></i></a></span>
                            <span class="@if (Auth::user()->id != $course->professor_id) d-none @endif pe-1"><a href="{{ route('course#deletePage',[$course->course_id]) }}" class="image" title="Delete"><i class="fa-solid fa-trash-can fs-5 ms-2 text-danger"></i></a></span>
                        </div>
                    </div>
                    <p class="text-black mb-1">{{ $course->course_content }} <br>
                        <div class="d-flex justify-content-between">
                            <b class="text-muted float-end">Difficulty : @if ($course->difficulty == "beginner")
                                <span class="text-success">Beginner</span>
                            @elseif ($course->difficulty == "intermediate")
                                <span class="text-warning">Intermediate</span>
                            @else
                                <span class="text-danger">Advanced</span>
                            @endif</b><br>
                            <b>No of Assignment : {{ $course->assignment }}</b>
                        </div>
                        <small>Enrolled Students : {{ $course->enrolled_students }}</small>
                    </p>
                @endforeach
                <p>
                    {{ $courses->links() }}
                </p>
            </div>
            <hr>
            {{-- Assignment --}}
            <div class="mb-5">
                @if (session('statusChange'))
                    <h6 class="text-success text-center fs-6">{{ session('statusChange') }}</h6>
                @endif
                <h5 class="mb-3 text-success">Students' Assignments</h5>
                @if (count($assignments) < 1)
                    <h4 class="text-success fa-bounce text-center mt-5">There is no student's submissions.</h4>
                @else
                    @foreach ($assignments as $assignment)
                        @if ($assignment->assignment_status == "pending")
                            <div class="row">
                                <div class="col-md-8 col-sm-12">
                                    <h6 class="text-primary">
                                        <i class="fa-solid fa-circle-dot fa-bounce fa-2xs pe-2"></i>
                                        {{ $assignment->course_title }}
                                    </h6>
                                    <span>Student's name - <b class="text-success">{{ $assignment->name }}</b></span>
                                    <div>
                                        Assignment - {{ $assignment->assignment_no }} <br><a href="{{ $assignment->assignment_link }}" target="_blank"><span style="font-size: 15px">{{ $assignment->assignment_link }}</span></a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <form action="{{ route('teaching#assignment',[$assignment->assignment_id]) }}" method="POST">
                                        @csrf
                                        <label for="assignmentStatus">Status</label>
                                        <div class="d-flex">
                                            <select name="assignmentStatus" id="assignmentStatus" class="form-control me-2">
                                                <option value="pending" selected disabled>Pending</option>
                                                <option value="fail">Fail</option>
                                                <option value="pass">Pass</option>
                                            </select>
                                            <input type="submit" value="submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr>
                        @endif
                    @endforeach
                    <p>
                        {{ $assignments->links() }}
                    </p>
                @endif
            </div>
        </section>
    </div>
@endsection
