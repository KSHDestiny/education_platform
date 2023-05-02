@extends('admin.layouts.master')

@section('title')
    <title>Professor Edit Page</title>
@endsection

@section('header')
    <header id="header">
        <a href="#" class="logo">Education Platform</a>
        <h3 class="mt-3">@if (Auth::user()->id == $userData->id)
            My
        @else
        {{ $userData->name }}'s
        @endif Profile</h3>
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
<div id="footer">
    <section>
            <ul class="list-unstyled">
                <li class="text-black row my-2"><b class="col-3 offset-1">Name: </b><span class="h5 col">{{ $userData->name }}</span></li>
                <li class="text-black row my-2"><b class="col-3 offset-1">Role: </b><span class="h5 col">{{ $userData->role }}</span></li>
                <li class="text-black row my-2"><b class="col-3 offset-1">Email: </b><span class="h5 col">{{ $userData->email }}</span></li>
                <li class="text-black row my-2"><b class="col-3 offset-1">Gender: </b><span class="h5 col">@if (!$userData->gender)
                    <span class="text-danger">no data</span>
                @else
                    {{ $userData->gender }}
                @endif</span></li>
                <li class="text-black row my-2"><b class="col-3 offset-1">Age: </b><span class="h5 col">@if (!$userData->age)
                    <span class="text-danger">no data</span>
                @else
                    {{ $userData->age }}
                @endif</span></li></span></li>
                <li class="text-black row my-2"><b class="col-3 offset-1">Phone: </b><span class="h5 col">@if (!$userData->phone)
                    <span class="text-danger">no data</span>
                @else
                    {{ $userData->phone }}
                @endif</span></li></span></li>
                <li class="text-black row my-2"><b class="col-3 offset-1">Education: </b><span class="h5 col">{{ $userData->education }}</span></li>
                <li class="text-black row my-2"><b class="col-3 offset-1">Profile: </b><img class="col-md-4 col-sm-12" src="@if (empty($userData->profile) && $userData->gender == "male"  || $userData->gender == null)
                    {{ asset('asset2/images/unknown_male.png') }}
                @elseif (empty($userData->profile) && $userData->gender == "female")
                    {{ asset('asset2/images/unknown_female.png') }}
                @else
                    {{ asset('storage/'.$userData->profile) }}
                @endif" width="300px" height="300px" alt=""></li>
                <li class="text-black row my-2"><b class="col-3 offset-1">Description: </b><span class="h5 col-md-8 col-sm-12">{{ $userData->description }}</span></li>
                <ul class="actions d-flex justify-content-end h4 mt-3">
                    {{-- <li><a href="{{ route('admin#dashboard') }}" class="btn btn-dark p-2">Cancel</a></li> --}}
                    <div class="@if (Auth::user()->id != $userData->id) d-none @endif">
                        <a href="@if ($userData->role == 'founder')
                            {{ route('founder#editPage',[$userData->id]) }}
                        @else
                            {{ route('professor#editPage',[$userData->id]) }}
                        @endif" class="btn btn-outline-secondary text-black">Edit Profile Page</a>
                    </div>
                </ul>
            </ul> <hr>
            <div class="@if (Auth::user()->id != $userData->id) d-none @endif">
                <h4>Change Password</h4>
                <form action="{{ route('admin#changePassword') }}" method="POST">
                    @csrf
                    <div class="fields">
                        <div class="field">
                            <label for="old_password">Old Password</label>
                            <input type="password" name="old_password" id="old_password" />
                        </div>
                        @if (session('passwordError'))
                            <p class="text-danger">{{ session('passwordError') }}</p>
                        @endif
                        <div class="field">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" id="new_password" />
                            @error('new_password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" />
                            @error('confirm_password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="Change Password" /></li>
                    </ul>
                </form>
            </div>
    </section>
</div>
@endsection
