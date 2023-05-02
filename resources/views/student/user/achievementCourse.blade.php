@extends('student.layouts.master')

@section('title')
    <title>{{ $course->course_title }}'s Lessons Page</title>
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
            <a class="nav-link active" aria-current="page" href="{{ route('student#achievement') }}">Achievements</a>
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
            <a class="nav-link active" aria-current="page" href="{{ route('student#achievement') }}">Achievements</a>
        </li>
        <li class="nav-item">
            <a href=""><img src="" alt=""></a>
        </li>
        </ul>
    </div>
@endsection


@section('content')

<div id="three">
    <h5 class="text-center text-info my-3">{{ $course->course_title }}</h5>
    <h6 class="mb-4">Your rating -
        @if ($enroll->rating != null)
            <i class = "fa fa-star ms-3" aria-hidden = "true" id = "star1"></i>
            <i class = "fa fa-star" aria-hidden = "true" id = "star2"></i>
            <i class = "fa fa-star" aria-hidden = "true" id = "star3"></i>
            <i class = "fa fa-star" aria-hidden = "true" id = "star4"></i>
            <i class = "fa fa-star" aria-hidden = "true" id = "star5"></i>

            <input type="hidden" id="rating" name="rating" value="{{ old('rating',$enroll->rating) }}">
            <a href="{{ route('student#reRate',[$enroll->enroll_id]) }}" class="ms-3">Rerate?</a>
        @else
            <i class = "fa fa-star ms-3" aria-hidden = "true" id = "st1"></i>
            <i class = "fa fa-star" aria-hidden = "true" id = "st2"></i>
            <i class = "fa fa-star" aria-hidden = "true" id = "st3"></i>
            <i class = "fa fa-star" aria-hidden = "true" id = "st4"></i>
            <i class = "fa fa-star" aria-hidden = "true" id = "st5"></i>

            <form action="{{ route('student#rating',[$enroll->enroll_id]) }}" class="d-inline-block" method="POST">
                @csrf
                <input type="hidden" id="rating" name="rating" value="{{ old('rating',$enroll->rating) }}">

                <button class="btn btn-warning ms-3">Send</button>
            </form>
        @endif
    </h6>
    @foreach ($lessons as $lesson)
        <div class="card my-2">
            <div class="card-header bg-warning text-white h6">Lesson - {{ $lesson->lesson }}</div>
            <div class="card-body">{{ $lesson->lesson_description }}</div>
            <div class="card-footer d-flex justify-content-between">
                <b>Here is the link -> </b>
                <a href="{{ $lesson->lesson_link }}" target="_blank">{{ $lesson->lesson_link }}</a>
            </div>
        </div>
    @endforeach
        <p>
            {{ $lessons->links() }}
        </p>
</div>
@endsection

@section('script')
    <script type="application/javascript">
        $(document).ready(function(){
            setTimeout(star, 100);

            function star(){
                let star;
                $("#st1").click(function() {
                    $(".fa-star").css("color", "black");
                    $("#st1").css("color", "yellow");
                    star = 1;
                    $('#rating').val(star);
                });

                $("#st2").click(function() {
                    $(".fa-star").css("color", "black");
                    $("#st1, #st2").css("color", "yellow");
                    star = 2;
                    $('#rating').val(star);
                });

                $("#st3").click(function() {
                    $(".fa-star").css("color", "black")
                    $("#st1, #st2, #st3").css("color", "yellow");
                    star = 3;
                    $('#rating').val(star);
                });

                $("#st4").click(function() {
                    $(".fa-star").css("color", "black");
                    $("#st1, #st2, #st3, #st4").css("color", "yellow");
                    star = 4;
                    $('#rating').val(star);
                });

                $("#st5").click(function() {
                    $(".fa-star").css("color", "black");
                    $("#st1, #st2, #st3, #st4, #st5").css("color", "yellow");
                    star = 5;
                    $('#rating').val(star);
                });

                if($('#rating').val() > 0){
                    for (let i = 0; i < $('#rating').val(); i++) {
                        $(`#star${i+1}`).css("color", "yellow");
                    }
                }
            }
        });
    </script>
@endsection
