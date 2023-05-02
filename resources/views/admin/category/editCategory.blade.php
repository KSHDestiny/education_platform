@extends('admin.layouts.master')

@section('title')
    <title>Category Edit Page</title>
@endsection

@section('header')
<header id="header">
    <a href="#" class="logo">Education Platform</a>
    <h3 class="mt-3">Edit Category</h3>
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
        <form method="post" action="{{ route('category#edit',[$category->category_id]) }}">
            @csrf
            <div class="fields">
                <div class="field">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="{{old('title', $category->title)}}" id="title" placeholder="Edit Category title..." />
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label for="content">Content</label>
                    <input type="text" name="content" value="{{old('content', $category->content)}}" id="content" placeholder="Edit Category content..." />
                    @error('content')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <ul class="actions d-flex justify-content-between">
                <li><a href="{{ route('teaching#page') }}" class="btn btn-dark p-2">Cancel</a></li>
                <li><input type="submit" value="Edit Category" /></li>
            </ul>
        </form>
    </section>
</footer>
@endsection
