@extends('admin.layouts.master')

@section('title')
    <title>Course Edit Page</title>
@endsection

@section('header')
<header id="header">
    <a href="#" class="logo">Education Platform</a>
    <h3 class="mt-3">Edit Course</h3>
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
<footer id="footer">
    <section>
        <form method="post" action="{{ route('course#edit',[$course->course_id]) }}" class="mt-5" enctype="multipart/form-data">
            @csrf
            <div class="fields">
                <div class="field">
                    <label for="category">Category</label>
                    <select name="categoryId" id="category">
                        <option value="" selected disabled>Choose Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}" @if ($category->category_id == $course->category_id) selected @endif class="@if (Auth::user()->id == $category->professor_id) bg-secondary text-white @endif">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @error('categoryId')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <input type="hidden" name="professorId" value="{{ Auth::user()->id }}" id="content" />
                </div>
                <div class="field">
                    <label for="title">Course Title</label>
                    <input type="text" name="courseTitle" value="{{ old('courseTitle',$course->course_title) }}" id="title" />
                    @error('courseTitle')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label for="content">Course Content</label>
                    <input type="text" name="courseContent" value="{{ old('courseContent',$course->course_content) }}" id="content" />
                    @error('courseContent')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label for="image">Course Image</label>
                    <input type="file" name="courseImage" id="image" class="form-control" />
                    @error('courseContent')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label for="difficulty">Difficulty</label>
                    <select name="difficulty" id="difficulty">
                        <option value="" selected disabled>Choose Difficulty</option>
                        <option value="beginner" @if ($course->difficulty == "beginner") selected @endif>Beginner</option>
                        <option value="intermediate" @if ($course->difficulty == "intermediate") selected @endif>intermediate</option>
                        <option value="advanced" @if ($course->difficulty == "advanced") selected @endif>Advanced</option>
                    </select>
                    @error('difficulty')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label for="assignment">Number of Assignment</label>
                    <input type="number" name="assignment" class="form-control" value="{{ old('assignment',$course->assignment) }}" id="assignment" min="0" />
                    @error('assignment')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <ul class="actions d-flex justify-content-between">
                <li><a href="{{ route('teaching#page') }}" class="btn btn-dark p-2">Cancel</a></li>
                <li><input type="submit" value="Edit Course" /></li>
            </ul>

        </form>
    </section>
</footer>
@endsection
