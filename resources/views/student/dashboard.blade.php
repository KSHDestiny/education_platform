@extends('student.layouts.master')

@section('title')
    <title>Education Platform Student's Page</title>
@endsection

@section('nav-sm')
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('student#profilePage') }}">Profile</a>
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
            <a class="nav-link" aria-current="page" href="{{ route('student#profilePage') }}">Profile</a>
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

    @if (session('successUpdate'))
        <h6 class="text-center text-warning mt-3">{{ session('successUpdate') }}</h6>
    @endif
    @if (session('enrollSuccess'))
        <h6 class="text-center text-success mt-3">{{ session('enrollSuccess') }}</h6>
    @endif

    <!-- One -->
    <section id="one">
        <header class="major">
            <h2><small>Welcome to</small> Education Platform</h2>
        </header>
        <p>Accumsan orci faucibus id eu lorem semper. Eu ac iaculis ac nunc nisi lorem vulputate lorem neque cubilia ac in adipiscing in curae lobortis tortor primis integer massa adipiscing id nisi accumsan pellentesque commodo blandit enim arcu non at amet id arcu magna. Accumsan orci faucibus id eu lorem semper nunc nisi lorem vulputate lorem neque cubilia.</p>
    </section>
    <p class="d-none" id="authUserId">{{ Auth::user()->id }}</p>
    <!-- Two -->
    <section id="two">
        <div class="row">
            <div class="col-lg-4 col-4 mb-5">
                <select id="courseOption">
                    <option value="" selected disabled>Choose Option ...</option>
                    <option value="desc">Latest Courses</option>
                    <option value="asc">Eariest Courses</option>
                </select>
            </div>
            <div class="col-lg-6 col-6 offset-2 d-flex">
                <input type="text" class="bg-light" id="searchData" placeholder="Search ...">
                <button class="btn border-0 fs-3 mb-5" id="searchBtn"><i class="fa-brands fa-searchengin fa-spin" style="color: #36a327;"></i></button>
            </div>
        </div>
        <h2>All Courses</h2>
        <div class="">
            <img src="{{ asset('asset/loading.gif') }}" id="loading" width="100%">
        </div>
        <div id="courses">
            @if (count($courses) < 1)
                <h2 class="text-center mt-5 text-danger">There is no such data.</h2>
            @else
                <div id="coursesField" class="row">
                    @foreach ($courses as $course)
                        <article class="col-md-6 col-sm-12 work-item">
                            <a href="{{ asset('storage/courseImages/'.$course->course_image) }}" class="image fit thumb"><img src="{{ asset('storage/courseImages/'.$course->course_image) }}" alt="" width="300px" height="200px" /></a>
                            <h3>{{ $course->course_title }}</h3>
                            <h6>({{ $course->category_title }} course)</h6>
                            <p>{{ $course->course_content }}</p>
                            <div class="d-flex justify-content-between">
                                <p><b class="fs-6 mt-1">Instructor - {{ $course->professor_name }}</b></p>
                                <h6 class="text-end"><b class="@if ($course->difficulty == "beginner")
                                    text-success
                                @elseif ($course->difficulty == "intermediate")
                                    text-warning
                                @else
                                    text-danger
                                @endif">{{ $course->difficulty }}</b></h6>
                            </div>
                            <div class="d-flex justify-content-between" id="courseRating">
                                <p>Enrolled Students : {{ $course->enrolled_students }}</p>
                                @php
                                    $rating = false;
                                    $rate;
                                    foreach ($courseRatings as $courseRating) {
                                        if($courseRating->course_id == $course->course_id){
                                            $rating = true;
                                            if ($courseRating->avgRating == null) {
                                                $rate = "no rating";
                                            }else{
                                                $rate = round($courseRating->avgRating, 1);
                                            }
                                        }
                                    }
                                @endphp
                                <p>Rating -@if ($rating == true && $rate == "no rating")
                                    <span class="text-muted"> no rating</span>
                                @elseif ($rating == true && $rate != "no rating")
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i+1 <= $rate)
                                        <i class = "fa fa-star text-warning aria-hidden"></i>
                                        @elseif ($i+0.5 <= $rate)
                                        <i class="fa-solid fa-star-half-stroke text-warning"></i>
                                        @else
                                        <i class = "fa fa-star aria-hidden"></i>
                                        @endif
                                    @endfor
                                @endif</p>
                            </div>
                            @php
                                $enrolled = false;
                                foreach ($enrolls as $enroll) {
                                    if ($enroll->course_id == $course->course_id) {
                                        $enrolled = true;
                                        break;
                                    }
                                }
                            @endphp

                            @if ($enrolled)
                                <ul class="actions d-flex justify-content-center">
                                    <li><button class="button" disabled>Enrolled</button></li>
                                </ul>
                            @else
                                <ul class="actions d-flex justify-content-center">
                                    <li class="fa-bounce text-black"><a href="{{ route('student#enroll',[$course->course_id]) }}" class="button">Enroll</a></li>
                                </ul>
                            @endif
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
        {{-- <p id="pagination">
            {{ $courses->appends(request()->query())->links() }}
        </p> --}}
    </section>
@endsection

@section('script')
    <script type="application/javascript">
        $(document).ready(function(){
            $('#loading').hide();
            // var page = 1;
            // var sort = "asc";
            // var search = "";

            // // get page number
            // $(document).on('click', '.pagination a', function(event){
            //     event.preventDefault();
            //     var page = $(this).attr('href').split('page=')[1];
            //     alert(page);
            // });


            // If Enter key is pressed, work search btn
            $('#searchData').on('keydown', function(e) {
                    if (e.keyCode == 13) {
                        // apply search btn function
                        $('#searchBtn').click();
                    }
            });

            // search btn function
            $('#searchBtn').click(function(){
                if(searchData != null || searchData != ""){
                    $('#loading').show();
                    $('#coursesField').hide();
                    // apply courseSorting function
                    setTimeout(courseSorting, 500);
                    setTimeout(loadingHide,1000);
                    setTimeout(courseShow,1500);
                }
            })

            // sorting Option (asc, desc)
            $('#courseOption').change(function(){
                $('#loading').show();
                $('#coursesField').hide();
                // apply courseSorting function
                setTimeout(courseSorting, 500);
                setTimeout(loadingHide,1000);
                setTimeout(courseShow,1500);
            });


            // *** Functions *** //

            // a href get enroll url
            function getEnrollUrl(courseId) {
                return "{{ route('student#enroll', ':courseId') }}".replace(':courseId', courseId);
            }


            // courseSorting function
            function courseSorting(){
                var sorting = $('#courseOption').val();
                var searchData = $('#searchData').val();
                var userId = $('#authUserId').html();

                $.ajax({
                        type: 'post',
                        url: '/api/course/sorting',
                        data: {
                            'sorting' : sorting,
                            'searchData' : searchData,
                            'userId' : userId
                        },
                        dataType: 'json',
                        success: function(response){
                            // console.log(response);
                            var courses = ``;
                            if(response.courses.length < 1){
                                courses = `<h2 class="text-center mt-5 text-danger">There is no such data.</h2>`;
                            }else{
                                courses = `<div id="coursesField" class="row">`;
                                for (var i = 0; i < response.courses.length; i++){
                                    var course = response.courses[i];
                                    var difficulty = course.difficulty;
                                    var color = "";

                                    // difficulty color
                                    if(difficulty == "beginner"){
                                        color = "text-success";
                                    }else if(difficulty == "intermediate"){
                                        color = "text-warning";
                                    }else {
                                        color = "text-danger";
                                    }

                                    // enrolled // notenrolled
                                    var enrolled = false;
                                    for (var y = 0; y < response.enrolls.length; y++) {
                                        if (response.enrolls[y].course_id == course.course_id) {
                                        enrolled = true;
                                        break;
                                        }
                                    }

                                    // var shortedSeeMore = true;
                                    // var seeMoreContent = course.course_content;
                                    // var content = course.course_content.length > 200? course.course_content.substr(0,200) + " <a href='#' id='seeMore'>See More...</a>" : course.course_content;
                                    // console.log(seeMoreContent);
                                    // console.log(content);
                                    // console.log(shortedSeeMore);

                                    // $('#seeMore').click(function(){
                                    //     return shortedSeeMore = false;
                                    // })


                                    courses += `
                                    <article class="col-md-6 col-sm-12 work-item">
                                        <a href="{{ asset('storage/courseImages/${course.course_image}') }}" class="image fit thumb"><img src="{{ asset('storage/courseImages/${course.course_image}') }}" alt="" width="300px" height="200px" /></a>
                                        <h3>${course.course_title}</h3>
                                        <h6>(${course.category_title} course)</h6>
                                        <p>${course.course_content}</p>
                                        <p><b class="fs-6 mt-1">Instructor - ${course.professor_name}</b></p>
                                        <h6 class="text-end"><b class="${color}">${difficulty}</b></h6>
                                        <div class="d-flex justify-content-between" id="courseRating${course.course_id}">
                                            <p>Enrolled Students : ${course.enrolled_students}</p>
                                        </div>`;

                                //@php
                                //     $rating = false;
                                //     $rate;
                                //     foreach ($courseRatings as $courseRating) {
                                //         if($courseRating->course_id == $course->course_id){
                                //             $rating = true;
                                //             if ($courseRating->avgRating == null) {
                                //                 $rate = "no rating";
                                //             }else{
                                //                 $rate = round($courseRating->avgRating, 1);
                                //             }
                                //         }
                                //     }
                                // @endphp
                                // <p>Rating @if ($rating == true && $rate == "no rating")
                                //     <span class="text-muted">- no rating</span>
                                // @elseif ($rating == true && $rate != "no rating")
                                //     @for ($i = 0; $i < 5; $i++)
                                //         @if ($i+1 <= $rate)
                                //
                                //         @elseif ($i+0.5 <= $rate)
                                //         <i class="fa-solid fa-star-half-stroke text-warning"></i>
                                //         @else
                                //         <i class = "fa fa-star aria-hidden"></i>
                                //         @endif
                                //     @endfor
                                // @endif</p>

                                    // enrolled
                                    if(enrolled){
                                        courses += `
                                            <ul class="actions d-flex justify-content-center enrolled">
                                                <li><button class="button" disabled>Enrolled</button></li>
                                            </ul>`;
                                    }   // notEnroll
                                    else {
                                        courses += `
                                            <ul class="actions d-flex justify-content-center not-enrolled">
                                                <li class="fa-bounce text-black"><a href="${getEnrollUrl(course.course_id)}" class="button">Enroll</a></li>
                                            </ul>`;
                                    }

                                    courses += '</article>';
                                }

                                courses += `</>`;
                            }
                            $('#courses').html(courses);

                            let rateText = ``;
                            for (var c = 0; c < response.courses.length; c++){
                                var course = response.courses[c];
                                let rating = false;
                                    let rate;

                                    for(let a = 0; a < response.courseRatings.length; a++){
                                        let courseRating = response.courseRatings[a];
                                        if(courseRating.course_id == course.course_id){
                                            rating = true;
                                            if (courseRating.avgRating == null) {
                                                rate = "no rating";
                                            }else{
                                                rate = courseRating.avgRating;
                                            }
                                        }
                                    }

                                    if(rating == true && rate == "no rating"){
                                        rateText = `<p>Rating <span class="text-muted">- no rating</span></p>`;
                                        $(`#courseRating${course.course_id}`).append(rateText);
                                    }else if (rating == true && rate != "no rating") {
                                        $(`#courseRating${course.course_id}`).append(`<p id="appendRate">Rating - </p>`);
                                        for(let b = 0; b < 5; b++){
                                            if (b+1 <= rate) {
                                                rateText = `<i class = "fa fa-star text-warning aria-hidden"></i>`;
                                            } else if (b+0.5 <= rate) {
                                                rateText = `<i class="fa-solid fa-star-half-stroke text-warning"></i>`;
                                            } else {
                                                rateText = `<i class = "fa fa-star aria-hidden"></i>`;
                                            }
                                            $(`#courseRating${course.course_id}`).find('#appendRate').append(rateText);
                                        }

                                    }
                            }

                        }
                })
            }

            function loadingHide(){
                $('#loading').hide();
            }

            function courseShow(){
                $('#coursesField').show();
            }
        });
    </script>
@endsection
