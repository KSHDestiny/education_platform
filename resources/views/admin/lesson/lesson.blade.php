@extends('admin.layouts.master')

@section('title')
    <title>Lesson Page</title>
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
        <h3 class="mt-3">Lessons</h3>
    </header>
@endsection

@section('navbar')
    <ul class="links">
        <li><a href="{{ route('admin#dashboard') }}">Professors</a></li>
        <li><a href="{{ route('category#page') }}">Categories</a></li>
        <li class="active"><a href="{{ route('course#page') }}">Courses</a></li>
        <li><a href="{{ route('teaching#page') }}">Teachings</a></li>
        <li><a href="{{ route('admin#studentListpage') }}">Students' Lists</a></li>
    </ul>
@endsection

@section('body')
<div id="footer">
    <section>
        <h4 class="text-center mb-5">Course Details</h4>
        <ul class="list-unstyled">
            <li class="text-center">
                <img src="{{ asset('storage/courseImages/'.$course->course_image) }}" class="img-width" height="300px" alt="">
            </li>
            <li class="text-black row my-2"><b class="col-md-3 offset-md-1">Course: </b><span class="h5 col">{{ $course->course_title }}</span></li>
            <li class="text-black row my-2"><b class="col-md-3 offset-md-1">Category: </b><span class="h5 col">{{ $course->category_title }}</span></li>
            <li class="text-black row my-2"><b class="col-md-3 col-sm-12 offset-md-1">Content: </b><span class="h5 col-md col-sm-12">{{ $course->course_content }}</span></li>
            <li class="text-black row my-2"><b class="col-md-3 offset-md-1">Professor: </b><span class="h5 col">{{ $course->professor_name }}</span></li>
            <li class="text-black row my-2"><b class="col-md-3 offset-md-1">Difficulty: </b><span class="h5 col">@if ($course->difficulty == "beginner")
                Beginner
            @elseif($course->difficulty == "intermediate")
                Intermediate
            @else
                Advanced
            @endif</span></li>
            <li class="text-black row my-2"><b class="col-md-3 offset-md-1">No of Assignment: </b><span class="h5 col">{{ $course->assignment }}</span></li>
            <li class="text-black row my-2"><b class="col-md-3 offset-md-1">Created at: </b><span class="h5 col">{{ $course->created_at->format('F jS, o') }}</span></li>
            <li class="text-black row my-2"><b class="col-md-3 offset-md-1">Last updated in: </b><span class="h5 col">{{ $course->updated_at->format('F jS, o') }}</span></li>
            <ul class="actions d-flex justify-content-end h4 mt-3">
                <div class="@if (Auth::user()->id != $course->professor_id) d-none @endif">
                    <a href="{{ route('course#editPage',[$course->course_id]) }}" class="btn btn-outline-secondary text-black">Edit Course Page</a>
                </div>
            </ul>
        </ul> <hr>

        <div class="footer">
            <h4 class="text-center my-5">Course Curriculum</h4>
            @if (session('updateSuccess'))
                <h6 class="text-center pb-2 text-warning">{{ session('updateSuccess') }}</h6>
            @endif
            @if (session('editSuccess'))
                <h6 class="text-center pb-2 text-warning">{{ session('editSuccess') }}</h6>
            @endif

            <table class="table table-bordered table-dark">
                <tr class="row">
                    <th class="col-2 text-center">Lesson</th>
                    <th class="col-6 text-center">Description</th>
                    <th class="col-4 text-center">Source</th>
                </tr>
                @foreach ($lessons as $lesson)
                    <tr class="row">
                        <td class="col-2 text-center"><a href="{{ route('lesson#changePage',[$lesson->lesson_id]) }}">Lesson {{ $lesson->lesson }}</a></td>
                        <td class="col-6">{{ $lesson->lesson_description }}</td>
                        <td class="col-4 text-break"><a href="{{ $lesson->lesson_link }}" target="_blank">{{ $lesson->lesson_link }}</a></td>
                    </tr>
                @endforeach
            </table>
            {{ $lessons->appends(request()->query())->links() }}
            <ul class="actions d-flex justify-content-end h4 mt-3">
                <div class="@if (Auth::user()->id != $course->professor_id) d-none @endif">
                    <a href="{{ route('lesson#createPage',[$course->course_id]) }}" class="btn btn-outline-secondary text-black">Manage Your Course Lessons</a>
                </div>
            </ul>
        </div>
    </section>
</div>
@endsection


