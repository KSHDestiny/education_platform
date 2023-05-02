@extends('admin.layouts.master')

@section('title')
    <title>Education Platform</title>
@endsection

<!-- Intro -->
@section('header')
    <div id="intro">
        @if($errors->any())
            <p class="text-danger">Opps! Something went wrong!</p>
        @endif
        @if (session('founderUpdate'))
            <p class="text-warning">{{ session('founderUpdate') }}</p>
        @endif
        @if (session('professorCreate'))
            <p class="text-success">{{ session('professorCreate') }}</p>
        @endif
        @if (session('professorUpdate'))
            <p class="text-warning">{{ session('professorUpdate') }}</p>
        @endif
        @if (session('professorDelete'))
            <p class="text-danger">{{ session('professorDelete') }}</p>
        @endif
        @if (session('passwordChange'))
            <p class="text-warning">{{ session('passwordChange') }}</p>
        @endif
        <h2>Welcome Back</h2>
        <h1>{{ Auth::user()->name }}</h1>
        <p>"Share your knowledge. It is a way to achieve immortality."</p>
        <ul class="actions">
            <li><a href="#header" class="button icon solid solo fa-arrow-down scrolly">Continue</a></li>
        </ul>
    </div>
    <!-- Header -->
    <header id="header">
        <a href="#" class="logo">Education Platform</a>
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
    <!-- Main -->
        <div id="main">

            <!-- Featured Post -->
                <article class="post featured">
                    <header class="major">
                        <span class="date">Founded in {{ $founder->created_at->format('M jS, o') }}</span>
                        <h2><small class="text-capitalize">Prof.</small>{{ $founder->name }}</h2>
                        <b class="h3">{{ $founder->education }}</b><br/>
                        <p><b>{{ $founder->email }}</b></p>
                        <p>{{ $founder->description }}</p>
                    </header>
                    <a href="{{ route('myProfile',[$founder->id]) }}" class="image"><img src="@if ($founder->profile == null && $founder->gender == "male")
                        {{ asset('asset2/images/unknown_male.png') }}
                    @elseif ($founder->profile == null && $founder->gender == "female")
                        {{ asset('asset2/images/unknown_female.png') }}
                    @else
                        {{ asset('storage/'.$founder->profile) }}
                    @endif" alt="" width="300px"/></a>
                    <ul class="actions special">
                        <li><a href="{{ route('founder#editPage') }}" class="button large @if(Auth::user()->role != 'founder') d-none @endif">Edit Profile</a></li>
                    </ul>
                </article>

            <!-- Posts -->
                <section class="posts">
                    @foreach ($professors as $professor)
                        <article>
                            <header>
                                <span class="date">Joined in {{ $professor->created_at->format('F jS, o') }}</span>
                                <h2><small class="text-capitalize">Prof.</small>{{ $professor->name }}</h2>
                                <b class="h5">{{ $professor->education }}</b><br/>
                            </header>
                            <a href="{{ route('myProfile',[$professor->id]) }}" class="image">
                                <img class="rounded-circle my-1" src="@if ($professor->profile == null && $professor->gender == "male" || $professor->profile == null &&  $professor->gender == null)
                                        {{ asset('asset2/images/unknown_male.png') }}
                                    @elseif ($professor->profile == null && $professor->gender == "female")
                                        {{ asset('asset2/images/unknown_female.png') }}
                                    @else
                                        {{ asset('storage/'.$professor->profile) }}
                                    @endif" alt="" width="200px" height="200px" />
                            </a> <br/>
                            <b>{{ $professor->email }}</b>
                            <p>{{ $professor->description }}</p>
                            <ul class="actions special">
                                <li><a href="{{ route('professor#editPage',[$professor->id]) }}" class="button @if($professor->id != Auth::user()->id) d-none @endif">Edit Profile</a></li>
                                <li><a href="{{ route('professor#deletePage',[$professor->id]) }}" class="button @if($professor->id != Auth::user()->id && Auth::user()->role != 'founder') d-none @endif">Leave / Retire</a></li>
                            </ul>
                        </article>
                    @endforeach
                </section>
                <div class="row">
                    <span class="p-0 col-md-6 offset-md-3">{{ $professors->links() }}</span>
                </div>
        </div>

    <!-- Footer -->
        <footer id="footer">
            <section class="@if(Auth::user()->role != 'founder') d-none @endif">
                <form method="post" action="{{ route('professor#create') }}">
                    @csrf
                    <div class="fields">
                        <div class="field">
                            <label for="userName">Professor's Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" id="userName" />
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="field">
                            <input type="hidden" name="role" value="professor" id="name" />
                        </div>
                        <div class="field">
                            <label for="education">Education</label>
                            <input type="text" name="education" value="{{ old('education') }}" id="education" />
                            @error('education')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{ old('email') }}" id="email" />
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" />
                            @error('password')
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
                        <div class="field">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" value="{{ old('description') }}" rows="5"></textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="Add Professor" /></li>
                    </ul>
                </form>
            </section>
            <section class="split contact">
                <section class="alt">
                    <h3>Address</h3>
                    <p>Rangoon, Myanmar</p>
                </section>
                <section>
                    <h3>Phone</h3>
                    <p><a href="tel:09123456789">(+95) 9123456789</a></p>
                </section>
                <section>
                    <h3>Email</h3>
                    <p><a href="mailto:educationplatform@gmail.com">educationplatform@gmail.com</a></p>
                </section>
                <section>
                    <h3>Social</h3>
                    <ul class="icons alt">
                        <li><a href="#" class="icon brands alt fa-twitter"><span class="label">Twitter</span></a></li>
                        <li><a href="#" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
                        <li><a href="#" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
                        <li><a href="#" class="icon brands alt fa-github"><span class="label">GitHub</span></a></li>
                    </ul>
                </section>
            </section>
        </footer>
@endsection
