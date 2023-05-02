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
            <a class="nav-link active" aria-current="page" href="{{ route('student#enrolledCoursePage') }}">Courses</a>
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
            <a class="nav-link active" aria-current="page" href="{{ route('student#enrolledCoursePage') }}">Courses</a>
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
    <h5 class="text-center text-info my-3">{{ $course->course_title }}</h5>
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
<div>
    <h5 class="text-warning d-inline-block me-3">Rate this course</h5> :
    @if ($course->rating != null)
        <i class = "fa fa-star ms-3" aria-hidden = "true" id = "star1"></i>
        <i class = "fa fa-star" aria-hidden = "true" id = "star2"></i>
        <i class = "fa fa-star" aria-hidden = "true" id = "star3"></i>
        <i class = "fa fa-star" aria-hidden = "true" id = "star4"></i>
        <i class = "fa fa-star" aria-hidden = "true" id = "star5"></i>

        <input type="hidden" id="rating" name="rating" value="{{ old('rating',$course->rating) }}">
        <a href="{{ route('student#reRate',[$course->enroll_id]) }}" class="ms-3">Rerate?</a>
    @else
        <i class = "fa fa-star ms-3" aria-hidden = "true" id = "st1"></i>
        <i class = "fa fa-star" aria-hidden = "true" id = "st2"></i>
        <i class = "fa fa-star" aria-hidden = "true" id = "st3"></i>
        <i class = "fa fa-star" aria-hidden = "true" id = "st4"></i>
        <i class = "fa fa-star" aria-hidden = "true" id = "st5"></i>

        <form action="{{ route('student#rating',[$course->enroll_id]) }}" class="d-inline-block" method="POST">
            @csrf
            <input type="hidden" id="rating" name="rating" value="{{ old('rating',$course->rating) }}">

            <button class="btn btn-warning ms-3">Send</button>
        </form>
    @endif
</div>
<hr>
<div id="four">
    @if (session('submissionSuccess'))
        <p class="text-success text-center">{{ session('submissionSuccess') }}</p>
    @endif
    @if (session('resubmitPermitted'))
        <p class="text-success text-center">{{ session('resubmitPermitted') }}</p>
    @endif

    {{-- @if ($course->assignment == $passAssignments)
        <h4 class="text-success text-center fa-bounce my-3">Congratulations! You have completed this course!</h4>
    @endif --}}

    <h5>Assignment Submission</h5>
    <ul class="text-primary">
        <li>If you have submitted your assignment, you have to wait your instructor's response.</li>
        <li>After passing previous assignments, you are avaliable to submit next assignments.</li>
    </ul>
    @for ($i = 0; $i < $course->assignment; $i++)
        <form action="{{ route('student#courseAssignment',[$course->course_id]) }}" method="post" class="form">
            @csrf
            <div class="form-fields">
                <div class="form-field">
                    <label for="assignment"><b>Assignment {{ $i+1 }}</b></label>
                    @if ($i < count($assignments))
                        @for($x = 0; $x < count($assignments); $x++)
                            @php
                                $status = "pending";
                            @endphp
                            @if ($assignments[$i]->assignment_status == "pending")
                                @php
                                    $status = "pending";
                                    break;
                                @endphp
                            @elseif ($assignments[$i]->assignment_status == "fail")
                                @php
                                    $status = "fail";
                                    break;
                                @endphp
                            @else
                                @php
                                    $status = "pass";
                                    break;
                                @endphp
                            @endif
                        @endfor
                        @if ($status == "pending")
                            <div class="d-flex">
                                <input type="text" name="assignmentLink" class="text-muted" value="{{ $assignments[$i]->assignment_link }}" id="assignment" disabled>
                                <input type="button" class="ms-3" value="Submitted" disabled>
                            </div>
                        @elseif ($status == "fail")
                            <div class="d-flex">
                                <input type="text" name="assignmentLink" class="text-muted" value="{{ $assignments[$i]->assignment_link }}" id="assignment" disabled>
                                <input type="button" class="ms-3" style="letter-spacing: 2px" value="Fail" disabled>
                            </div>
                            <p class="text-danger">You failed this assignment. Wanna try again?
                                <a href="{{ route('student#assignmentResubmit',[$assignments[$i]->assignment_id]) }}" class="text-danger">Resubmit!</a>
                            </p>
                        @else
                            <div class="d-flex">
                                <input type="text" name="assignmentLink" class="text-muted" value="{{ $assignments[$i]->assignment_link }}" id="assignment" disabled>
                                <input type="button" class="ms-3" value="Passed" disabled>
                            </div>
                        @endif
                    @elseif (count($assignments) >= $i)
                        @php
                            $previousStatus = true;
                        @endphp
                        @for($y = 0; $y < count($assignments); $y++)
                            @if ($assignments[$y]->assignment_status == "pending" || $assignments[$y]->assignment_status == "fail")
                                @php
                                    $previousStatus = false;
                                @endphp
                            @else
                                @php
                                    $previousStatus = true;
                                @endphp
                            @endif
                        @endfor
                        @if ($previousStatus)
                            <div class="d-flex">
                                <input type="hidden" name="assignmentNo" value="{{ $i + 1 }}" />
                                <input type="text" name="assignmentLink" placeholder="Submit Your Assignment" id="assignment">
                                <input type="submit" class="ms-3" value="Submit" />
                            </div>
                            @error('assignmentLink')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        @else
                            <div class="d-flex">
                                <input type="text" name="assignmentLink" placeholder="Unavailable Submission" id="assignment" disabled>
                                <input type="submit" class="ms-3" value="Submit" disabled>
                            </div>
                        @endif
                    @else
                        <div class="d-flex">
                            <input type="text" name="assignmentLink" placeholder="Unavailable Submission" id="assignment" disabled>
                            <input type="submit" class="ms-3" value="Submit" disabled>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    @endfor
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
