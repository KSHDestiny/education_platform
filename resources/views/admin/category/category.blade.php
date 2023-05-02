@extends('admin.layouts.master')

@section('title')
    <title>Category Page</title>
@endsection

@section('header')
    <header id="header">
        <a href="#" class="logo">Education Platform</a>
        <h3 class="mt-3">Categories</h3>
    </header>
@endsection

@section('navbar')
    <ul class="links">
        <li><a href="{{ route('admin#dashboard') }}">Professors</a></li>
        <li class="active"><a href="{{ route('category#page') }}">Categories</a></li>
        <li><a href="{{ route('course#page') }}">Courses</a></li>
        <li><a href="{{ route('teaching#page') }}">Teachings</a></li>
        <li><a href="{{ route('admin#studentListpage') }}">Students' Lists</a></li>
    </ul>
@endsection

@section('body')
<div id="footer">
    <section>
        @if (session('createSuccess'))
            <h6 class="text-success text-center fs-6">{{ session('createSuccess') }}</h6>
        @endif
        <h5 class="text-center text-black mb-5">Here are all categories we are providing in our Education Platform</h5>
            @foreach ($categories as $category)
                <ul class="list-unstyled text-black">
                    <li><h4 class="d-inline text-primary">{{ $category->category_id }}. {{ $category->title }}</h4>
                        {{-- <span class="@if (Auth::user()->id != $category->professor_id) d-none @endif">
                            <a href="{{ route('category#editPage',[$category->category_id]) }}" class="image" title="Edit">
                                <i class="fa-regular fa-pen-to-square fs-5 ms-2 text-primary"></i>
                            </a>
                        </span>
                        <span class="@if (Auth::user()->id != $category->professor_id) d-none @endif">
                            <a href="{{ route('catagory#deletePage',[$category->category_id]) }}" class="image" title="Delete">
                                <i class="fa-solid fa-trash-can fs-5 ms-2 text-danger"></i>
                            </a>
                        </span> --}}
                    </li>
                    <li><p>{{ $category->content }}</p></li>
                    <li class="text-end"><small>created by {{ $category->professor_name }}, created at {{ $category->created_at->format('F jS, o') }}</small></li>
                    <li class="text-end"><small>( last updated in {{ $category->updated_at->format('F jS, o') }} )</small></li>
                </ul><hr>
            @endforeach

            <div class="row">
                <span class="p-0 col-md-6 offset-md-3">{{ $categories->links() }}</span>
            </div>

            <form method="post" action="{{ route('category#create') }}">
                @csrf
                <div class="fields">
                    <div class="field">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" id="title" />
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="content">Content</label>
                        <input type="text" name="content" value="{{ old('content') }}" id="content" />
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <input type="hidden" name="professorId" value="{{ Auth::user()->id }}" id="content" />
                    </div>
                </div>
                <ul class="actions">
                    <li><input type="submit" value="Create Category" /></li>
                </ul>
            </form>
    </section>
</div>
@endsection
