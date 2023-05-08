@extends('student.layouts.master')

@section('title')
    <title>Discussion Forem</title>
    <style>
        .img-size{
            width: 300px;
            height: 200px;
        }

        .prof-img-size{
            width: 75px;
            height: 75px;
        }

        @media (max-width: 1150px) and (min-width: 981px){
            .img-size{
                width: 250px;
                height: 150px;
            }

            .prof-img-size{
                width: 50px;
                height: 50px;
            }
        }

        @media (max-width: 851px) and (min-width: 768px){
            .img-size{
                width: 200px;
                height: 150px;
            }

            .prof-img-size{
                width: 50px;
                height: 50px;
            }
        }

        @media(max-width: 421px) {
            .img-size{
                width: 200px;
                height: 150px;
            }

            .prof-img-size{
                width: 50px;
                height: 50px;
            }
        }
    </style>
@endsection

@section('nav-sm')
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student#profilePage') }}">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student#enrolledCoursePage') }}">Courses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student#achievement') }}">Achievements</a>
        </li>
        <li class="nav-item">
            <a href=""><img src="" alt=""></a>
        </li>
        </ul>
        <div class="nav-item">
            <a href="{{ route('student#discussionPage') }}" title="Discussion" class="mt-3 border-0 bg-pale"><img src="{{ asset('asset3/css/images/messenger.png') }}" width="50px" alt=""></a>
            <a href="#" onclick="document.getElementById('myForm').submit(); return false;" title="Logout"><img src="{{ asset('asset3/css/images/logout.png') }}" class="image bg-pale" alt="" width="30px"></a>
        </div>
    </div>
@endsection

@section('nav')
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student#profilePage') }}">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student#enrolledCoursePage') }}">Courses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student#achievement') }}">Achievements</a>
        </li>
        <li class="nav-item">
            <a href=""><img src="" alt=""></a>
        </li>
        </ul>
    </div>
@endsection


@section('content')

<div id="three">
    <form id="myForm" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
        <input type="submit" value="Logout">
    </form>
    <div class="inner">
        <div class="card">
            <div class="card-header text-center h6">Choose your discussion group</div>
            <div class="card-body">
                <div class="row">
                    @if (count($courses) < 1)
                        <h6 class="text-danger text-center">There is no courses enrolled!</h6>
                    @else
                        @foreach ($courses as $course)
                            <div class="list-group col-lg-6 col-md-6 col-sm-12">
                                <a href="{{ route('discussionPage',[$course->chat_id]) }}" class="list-group-item list-group-item-action col-6">
                                    <div class="text-center position-relative">
                                        <img src="{{ asset('storage/courseImages/'.$course->course_image) }}" alt="" class="img-size">
                                        <div class="position-absolute bottom-0 start-50 translate-middle-x col-3 offset-3 col-sm-3 offset-sm-2 col-md-3 offset-md-3 col-lg-4 offset-lg-4">
                                            <img src="{{ asset('storage/'.$course->profile) }}" alt="" class="prof-img-size rounded-circle">
                                        </div>
                                    </div>
                                    <div class="text-center">{{ $course->course_title }}</div>
                                </a>
                            </div>
                            {{-- <a href="#" class="list-group-item list-group-item-action active text-white" aria-current="true">{{ $course->course_title }}</a> --}}
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
