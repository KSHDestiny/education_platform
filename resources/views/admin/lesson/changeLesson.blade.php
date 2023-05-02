@extends('admin.layouts.master')

@section('title')
    <title>Lesson Page</title>
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
        <li><a href="{{ route('course#page') }}">Courses</a></li>
        <li class="active"><a href="{{ route('teaching#page') }}">Teachings</a></li>
        <li><a href="{{ route('admin#studentListpage') }}">Students' Lists</a></li>
    </ul>
@endsection

@section('body')
<div id="footer">
    <section>
        <h4 class="text-center mb-5">Lesson {{ $lesson->lesson }}</h4>
        <div class="footer">
            <form action="{{ route('lesson#change',[$lesson->lesson_id]) }}" method="POST">
                @csrf
                <div class="fields">
                    <input type="hidden" name="course_id" value="{{ $lesson->course_id }}">
                    <input type="hidden" name="lesson" value="{{ $lesson->lesson }}">
                    <div class="field">
                        <label>Lesson's Description</label>
                        <textarea name='lessonDescription' cols='10' rows='3'>{{ old('lessonDescription',$lesson->lesson_description) }}</textarea>
                        @error('lessonDescription')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label>Lesson's Link</label>
                        <input type='text' name='lessonLink' value='{{ old('lessonLink',$lesson->lesson_link) }}' />
                        @error('lessonLink')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('lesson#page',[$lesson->course_id]) }}" class="btn btn-dark p-2">Cancel</a>
                            <input type="submit" value="Change">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection


