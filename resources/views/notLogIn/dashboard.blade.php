<!DOCTYPE HTML>
<html>
	<head>
        <title>Education Platform Introduction's Page</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="icon" href="{{ asset('asset1/images/diamond.png') }}">
		<link rel="stylesheet" href="{{ asset('asset3/css/main.css') }}" />
		<!-- bootstrap cdn link -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        {{-- fontawesome cdn --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

		<style>
            .bg-pale{
                background-color: #fafafa;
            }

            .text-green {
                color: #00aa1a;
            }

            .border-green {
                border-color: #00aa1a;
            }

			@media(min-width: 981px){
				.nav-none{
					display: block;
				}

				.nav-sm-none{
					display: none;
				}
			}

			@media(max-width: 980px){
				.nav-none{
					display: none;
				}

				.nav-sm-none{
					display: block;
				}
			}
		</style>
	</head>
	<body class="is-preload">
		<nav class="navbar navbar-expand-lg bg-body-tertiary nav-sm-none ">
            <div class="container-fluid">
                <a class="navbar-brand image px-3" href="{{ route('welcome') }}">Education Platform</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                {{-- nav-sm --}}
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('login') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Achievements</a>
                    </li>
                    <li class="nav-item">
                        <a href=""><img src="" alt=""></a>
                    </li>
                    </ul>
                    <div class="nav-item">
                        <a href="{{ route('student#discussionPage') }}" title="Discussion" class="mt-3 border-0 bg-pale"><img src="{{ asset('asset3/css/images/messenger.png') }}" width="50px" alt=""></a>
                        {{-- <a href="#" onclick="document.getElementById('myForm').submit(); return false;" title="Logout"><img src="{{ asset('asset3/css/images/logout.png') }}" class="image bg-pale" alt="" width="30px"></a> --}}
                    </div>
                </div>

            </div>
          </nav>

        <!-- Header -->
			<header id="header">
                {{-- <form id="myForm" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    <input type="submit" value="Logout">
                </form> --}}
				<div class="inner">
					<h3><strong>User Name</strong></h3>
					<p class="mt-2"><strong>User's Email</strong></p>
                    <a href="{{ route('student#profilePage') }}" class="image avator"><img class="border border-white" src="{{ asset('asset2/images/unknown_male.png') }}" alt="" height="150px"/></a>
                    <p class="text-capitalize">
                        User's Education
                    </p>
                    <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, iure explicabo alias commodi neque ratione voluptatem delectus expedita nemo iusto facilis aliquid impedit error libero nisi ea voluptates magni eaque.</p>
				</div>
			</header>

		<!-- Main -->
			<div id="main">
				<nav class="navbar navbar-expand-lg bg-body-tertiary nav-none ">
					<div class="container-fluid">
                        <a class="navbar-brand image px-3" href="{{ route('welcome') }}">Education Platform</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        {{-- nav --}}
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('login') }}">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Courses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Achievements</a>
                            </li>
                            <li class="nav-item">
                                <a href=""><img src="" alt=""></a>
                            </li>
                            </ul>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('login') }}" title="Discussion" class="mt-3 border-0 bg-pale"><img src="{{ asset('asset3/css/images/messenger.png') }}" width="50px" alt=""></a>
                            {{-- <a href="#" onclick="document.getElementById('myForm').submit(); return false;" title="Logout"><img src="{{ asset('asset3/css/images/logout.png') }}" class="image bg-pale" alt="" width="25px"></a> --}}
                        </div>
					</div>
				  </nav>

                  {{-- content --}}
                  <section id="one">
                    <header class="major">
                        <h2><small>Welcome to</small> Education Platform</h2>
                    </header>
                    <p>Accumsan orci faucibus id eu lorem semper. Eu ac iaculis ac nunc nisi lorem vulputate lorem neque cubilia ac in adipiscing in curae lobortis tortor primis integer massa adipiscing id nisi accumsan pellentesque commodo blandit enim arcu non at amet id arcu magna. Accumsan orci faucibus id eu lorem semper nunc nisi lorem vulputate lorem neque cubilia.</p>
                </section>
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
                        <img src="{{ asset('asset/loading.gif') }}" id="loading">
                    </div>
                    <div id="courses">
                        @if (count($courses) < 1)
                            <h2 class="text-center mt-5 text-danger">There is no such data.</h2>
                        @else
                            <div id="coursesField" class="row">
                                @foreach ($courses as $course)
                                    <article class="col-6 col-12-xsmall work-item">
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
                                    </article>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    {{-- <p id="pagination">
                        {{ $courses->appends(request()->query())->links() }}
                    </p> --}}
                </section>
			</div>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<ul class="icons">
						<li><a href="https://www.twitter.com" target="_blank" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="https://www.github.com" target="_blank" class="icon brands fa-github"><span class="label">Github</span></a></li>
						<li><a href="https://www.chrome.com" target="_blank" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="https://www.gmail.com" target="_blank" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Education Platform</li><li>2023 All Rights Reserved</a></li>
					</ul>
				</div>
			</footer>
		<!-- Scripts -->
			<script src="{{ asset('asset3/js/jquery.min.js') }}"></script>
			<script src="{{ asset('asset3/js/jquery.poptrox.min.js') }}"></script>
			<script src="{{ asset('asset3/js/browser.min.js') }}"></script>
			<script src="{{ asset('asset3/js/breakpoints.min.js') }}"></script>
			<script src="{{ asset('asset3/js/util.js') }}"></script>
			<script src="{{ asset('asset3/js/main.js') }}"></script>

			<!-- bootstrap cdn js -->
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
            {{-- fontawesome js --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            <script type="application/javascript">
                $(document).ready(function(){
                    $('#loading').hide();

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
                    // function getEnrollUrl(courseId) {
                    //     return "{{ route('student#enroll', ':courseId') }}".replace(':courseId', courseId);
                    // }


                    // courseSorting function
                    function courseSorting(){
                        var sorting = $('#courseOption').val();
                        var searchData = $('#searchData').val();

                        $.ajax({
                                type: 'post',
                                url: '/api/course/sorting',
                                data: {
                                    'sorting' : sorting,
                                    'searchData' : searchData,
                                },
                                dataType: 'json',
                                success: function(response){

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
                                            // var enrolled = false;
                                            // for (var y = 0; y < response.enrolls.length; y++) {
                                            //     if (response.enrolls[y].course_id == course.course_id) {
                                            //     enrolled = true;
                                            //     break;
                                            //     }
                                            // }

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
                                            <article class="col-6 col-12-xsmall work-item">
                                                <a href="{{ asset('storage/courseImages/${course.course_image}') }}" class="image fit thumb"><img src="{{ asset('storage/courseImages/${course.course_image}') }}" alt="" width="300px" height="200px" /></a>
                                                <h3>${course.course_title}</h3>
                                                <h6>(${course.category_title} course)</h6>
                                                <p>${course.course_content}</p>
                                                <p><b class="fs-6 mt-1">Instructor - ${course.professor_name}</b></p>
                                                <h6 class="text-end"><b class="${color}">${difficulty}</b></h6>
                                                <div class="d-flex justify-content-between" id="courseRating${course.course_id}">
                                                    <p>Enrolled Students : ${course.enrolled_students}</p>
                                                </div>`;
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
	</body>
</html>

