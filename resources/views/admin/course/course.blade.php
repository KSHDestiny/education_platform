@extends('admin.layouts.master')

@section('title')
    <title>Course Page</title>
@endsection

@section('header')
    <header id="header">
        <a href="#" class="logo">Education Platform</a>
        <h3 class="mt-3">Courses</h3>
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
        @if (session('createSuccess'))
            <p class="text-success text-center fs-6">{{ session('createSuccess') }}</p>
        @endif
        <h5 class="text-center text-black mb-5">Here are all courses we are providing in our Education Platform</h5>
        <div class="text-end">
            <form action="{{ route('course#page') }}" method="GET">
                @csrf
                <div class="row">
                    <select name="searchOption" id="" class="offset-lg-4 col-lg-2 offset-md-0 col-md-4 col-sm-12">
                        <option value="all" @if (request('searchOption') == "all") selected @endif>All</option>
                        <option value="title" @if (request('searchOption') == "title") selected @endif>Title</option>
                        <option value="category" @if (request('searchOption') == "category") selected @endif>Category</option>
                        <option value="professor" @if (request('searchOption') == "professor") selected @endif>Professor</option>
                        <option value="difficulty" @if (request('searchOption') == "difficulty") selected @endif>Difficulty</option>
                    </select>
                    <input type="text" class="col-md col-sm" name="q" value="{{ request('q') }}" placeholder="Search...">
                    <input type="submit" class="col-md-2 col-sm-4 text-center" value="Search">
                </div>
            </form>
        </div>
            <div class="card">
                @if (count($courses) < 1)
                    <h2 class="text-center my-5 text-danger">There is no course.</h2>
                @else
                    @foreach ($courses as $course)
                        <div class="card-footer text-decoration-none d-flex justify-content-between">
                            <a href="{{ route('lesson#page',[$course->course_id]) }}" class="text-decoration-none image" title="@if (Auth::user()->id == $course->professor_id)
                                Click to manage course
                            @else
                                Click for more details
                            @endif"><b class="text-info fa-fade">{{ $course->course_id }}. {{ $course->course_title }}</b></a>
                            {{-- <div>
                                <span class="@if (Auth::user()->id != $course->professor_id) d-none @endif"><a href="{{ route('course#editPage',[$course->course_id]) }}" class="image" title="Edit"><i class="fa-regular fa-pen-to-square fs-5 ms-2 text-primary"></i></a></span>
                                <span class="@if (Auth::user()->id != $course->professor_id) d-none @endif pe-1"><a href="{{ route('course#deletePage',[$course->course_id]) }}" class="image" title="Delete"><i class="fa-solid fa-trash-can fs-5 ms-2 text-danger"></i></a></span>
                            </div> --}}
                        </div>
                        <div class="card-body mb-3 text-dark">
                            <p class="fs-6 text-muted">Category : <span class="text-primary">{{ $course->category_title }}</span></p>
                            <p>{{ $course->course_content }}</p>
                            <small class="text-muted">Difficulty : @if ($course->difficulty == "beginner")
                                <span class="text-success">Beginner</span>
                            @elseif ($course->difficulty == "intermediate")
                                <span class="text-warning">Intermediate</span>
                            @else
                                <span class="text-danger">Advanced</span>
                            @endif</small>
                            <span class="float-end text-muted">Instructed by <b class="text-black">{{ $course->professor_name }}</b></span>
                        </div>
                    @endforeach
                @endif
            </div>
            <p>
                {{ $courses->appends(request()->query())->links() }}
            </p>
            {{-- <div class="row">
                <span class="p-0 col-md-6 offset-md-3"></span>
            </div> --}}

            <form method="post" action="{{ route('course#create') }}" class="mt-5" enctype="multipart/form-data">
                @csrf
                <div class="fields">
                    <div class="field">
                        <label for="category">Category</label>
                        <select name="categoryId" id="category">
                            <option value="" selected disabled>Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}" class="@if (Auth::user()->id == $category->professor_id) text-black @endif">{{ $category->title }}</option>
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
                        <input type="text" name="courseTitle" value="{{ old('courseTitle') }}" id="title" />
                        @error('courseTitle')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="content">Course Content</label>
                        <input type="text" name="courseContent" value="{{ old('courseContent') }}" id="content" />
                        @error('courseContent')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="image">Course Image</label>
                        <input type="file" name="courseImage" id="image" class="form-control" />
                        @error('courseImage')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="difficulty">Difficulty</label>
                        <select name="difficulty" id="difficulty">
                            <option value="" selected disabled>Choose Difficulty</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">intermediate</option>
                            <option value="advanced">Advanced</option>
                        </select>
                        @error('difficulty')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="assignment">Number of Assignment</label>
                        <input type="number" name="assignment" class="form-control" value="{{ old('assignment') }}" id="assignment" />
                        @error('assignment')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <ul class="actions">
                    <li><input type="submit" value="Create Course" /></li>
                </ul>
            </form>
    </section>
</div>
@endsection
