@extends('admin.layouts.master')

@section('title')
    <title>Discussion Forem</title>
@endsection

@section('header')
    <header id="header">
        <a href="#" class="logo">Education Platform</a>
        <h3 class="mt-3">Discussion</h3>
    </header>
@endsection

@section('navbar')
    <ul class="links">
        <li><a href="{{ route('admin#dashboard') }}">Professors</a></li>
        <li><a href="{{ route('category#page') }}">Categories</a></li>
        <li><a href="{{ route('course#page') }}">Courses</a></li>
        <li><a href="{{ route('teaching#page') }}">Teachings</a></li>
        <li><a href="{{ route('admin#studentListpage') }}">Students' Lists</a></li>
    </ul>
@endsection

@section('body')
<div id="footer">
    <section class="row">
        <div class="col-10 offset-1">
            <div class="list-group">
                <input type="hidden" value="{{ Auth::user()->id }}" id="professorId">
                <a class="list-group-item list-group-item-action disabled">Choose Your Course Discussion</a>
                <div id="coursesField">
                    @foreach ($courses as $course)
                        <a href="{{ route('discussionPage',[$course->chat_id]) }}" class="list-group-item list-group-item-action">{{ $course->course_title }}
                                @if ($course->seenCount > 10)
                                    <span class="badge text-bg-danger">10+</span>
                                @else
                                    <span class="badge text-bg-danger">{{ $course->seenCount }}</span>
                                @endif
                        </a>
                        {{-- <a href="#" class="list-group-item list-group-item-action active text-white" aria-current="true">{{ $course->course_title }}</a> --}}
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scriptJquery')
    <script type="application/javascript">
        $(document).ready(function(){
            var professorId = $('#professorId').val();
            setInterval(notification, 3000);

            // a href get enroll url
            function getDiscussionUrl(chatId) {
                return "{{ route('discussionPage',':chat_id') }}".replace(':chat_id', chatId);
            }

            function notification(){
                $.ajax({
                    type: 'get',
                    url: '/api/discussionNotification',
                    data: {'professorId' : professorId},
                    dataType: 'json',
                    success: function(response){
                        // console.log(response);
                        var courses = ``;
                        for(let i = 0; i < response.allCourses.length; i++){
                            var allCourse = response.allCourses[i];

                            if(allCourse.unseen == 0){
                                allCourse.unseen = '';
                            }

                            if(allCourse.unseen > 10){
                                allCourse.unseen = '10+';
                            }

                            courses += `
                            <a href="${getDiscussionUrl(allCourse.chat_id)}" class="list-group-item list-group-item-action">${allCourse.course_title}
                                <span class="badge text-bg-danger">${allCourse.unseen}</span>
                            </a>
                            `;

                        }

                        $('#coursesField').html(courses);

                    }
                })
            }
        })
    </script>
@endsection
