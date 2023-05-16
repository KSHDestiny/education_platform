@extends('admin.layouts.master')

@section('title')
    <title>Professor Edit Page</title>
@endsection

@section('header')
    <header id="header">
        <a href="#" class="logo">Education Platform</a>
        <h3 class="mt-3">Edit Your Profile</h3>
    </header>
@endsection

@section('navbar')
    <ul class="links">
        <li class="active"><a href="{{ route('admin#dashboard') }}">Professors</a></li>
        <li><a href="{{ route('category#page') }}">Categories</a></li>
        <li><a href="{{ route('course#page') }}">Courses</a></li>
        <li><a href="{{ route('teaching#page') }}">Teachings</a></li>
        <li><a href="{{ route('admin#studentListpage') }}">Students' Lists</a></li>
    </ul>
@endsection

@section('body')
<footer id="footer">
    <section>
        <form method="post" action="{{ route('professor#edit',[$professor->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="fields">
                <div class="field">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{old('name', $professor->name)}}" id="name" placeholder="Enter Your Name..." />
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{old('email', $professor->email)}}" id="email" placeholder="Enter Your Email..." />
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender">
                        <option value="" selected disabled>Choose Gender</option>
                        <option value="male" @if ($professor->gender == "male") selected @endif>Male</option>
                        <option value="female" @if ($professor->gender == "female") selected @endif>Female</option>
                    </select>
                    @error('gender')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label for="age">age</label>
                    <input type="number" class="form-control rounded-0 opacity-50 p-2" name="age" value="{{old('age', $professor->age)}}" id="age" placeholder="Enter Your Age..." />
                    @error('age')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" value="{{old('phone', $professor->phone)}}" id="phone" placeholder="Enter Your Phone..." />
                </div>
                <div class="field">
                    <label for="education">Education</label>
                    <input type="text" name="education" value="{{old('education', $professor->education)}}" id="education" placeholder="Enter Your Education..." />
                    @error('education')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label for="profile">Profile</label>
                    <input type="file" class="form-control opacity-50" name="profile" id="profile" />
                    @error('profile')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="5" placeholder="Enter Description...">{{old('description', $professor->description)}}</textarea>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <ul class="actions d-flex justify-content-between">
                <li><a href="{{ route('admin#dashboard') }}" class="btn btn-dark p-2">Cancel</a></li>
                <li><input type="submit" value="Edit Profile" /></li>
            </ul>
        </form>
    </section>
</footer>
@endsection
