@extends('admin.layouts.master')

@section('title')
    <title>Manage Lessons Page</title>
@endsection

@section('header')
    <header id="header">
        <a href="#" class="logo">Education Platform</a>
        <h3 class="mt-3">Manage Your Course Lessons</h3>
    </header>
@endsection

@section('navbar')
    <ul class="links">
        <li><a href="{{ route('admin#dashboard') }}">Professors</a></li>
        <li><a href="{{ route('category#page') }}">Categories</a></li>
        <li><a href="{{ route('course#page') }}">Courses</a></li>
        <li class="active"><a href="{{ route('teaching#page') }}">Teachings</a></li>
        <li><a href="{{ route('admin#studentListpage') }}">Students' Lists</a></li>
    </ul>
@endsection

@section('body')
<div id="footer">
    <section>
        <div class="">
            <h4 class="text-center mb-5">Manage Lessons</h4>
            <h6>Course Title : {{ $course->course_title }}</h6>
            <form action="{{ route('lesson#create',[$course->course_id]) }}" method="POST">
                @csrf
                <div class="fields">
                    <div class="field">
                        <div id="lessonContainer" class="row">
                            @php
                                $lessonCount = 1;
                                foreach ($lessons as $lesson) {
                                    if(!isset($lesson->lesson_description)) continue;
                                    if(!isset($lesson->lesson_link)) continue;

                                    $lessonDescription = htmlentities($lesson->lesson_description);
                                    $lessonLink = htmlentities($lesson->lesson_link);
                                    echo(
                                        "<div>
                                            <h6 class='mt-5'>Lesson $lessonCount</h6>
                                            <input type='hidden' name='data[$lessonCount][lesson]' value='$lessonCount'>
                                            <div>
                                                <label>Lesson's Description</label>
                                                <textarea name='data[$lessonCount][lessonDescription]' cols='10' rows='3' required>$lessonDescription</textarea>
                                            </div>
                                            <div class='mt-2'>
                                                <label>Lesson's Link</label>
                                                <input type='text' name='data[$lessonCount][lessonLink]' value='$lessonLink' required />
                                            </div>
                                        </div>"
                                    );
                                    $lessonCount++;
                                }
                                echo("<input type='hidden' id='getCount' value='$lessonCount'>")
                            @endphp
                        </div>
                        <span class="btn btn-secondary mt-3" id="lessonPlus">Lesson +</span>
                        <span class="btn btn-secondary mt-3" id="lessonMinus">Lesson -</span>
                    </div>
                </div>
                <ul class="actions d-flex justify-content-between">
                    <li><a href="{{ route('lesson#page',[$course->course_id]) }}" class="btn btn-dark p-2">Cancel</a></li>
                    <li><input type="submit" value="Create & Edit" /></li>
                </ul>
            </form>
        </div>
    </section>
</div>
@endsection

@section('scriptJquery')
    <script>
        var lessonCount = $("#getCount").val();

        $(document).ready(function(){
                $('#lessonPlus').click(function(event){
                    console.log("Add Lesson "+ lessonCount);

                    $("#lessonContainer").append(
                        `<div>
                            <h6 class="mt-5">Lesson `+ lessonCount +`</h6>
                            <input type="hidden" name="data[`+lessonCount+`][lesson]" value="`+ lessonCount +`">
                            <div>
                                <label>Lesson's Description</label>
                                <textarea name="data[`+ lessonCount +`][lessonDescription]" cols="10" rows="3" required></textarea>
                            </div>
                            <div class="mt-2">
                                <label>Lesson's Link</label>
                                <input type="text" name="data[`+ lessonCount +`][lessonLink]" required />
                            </div>
                        </div>`
                    );
                    lessonCount++;
                });

                    $('#lessonMinus').click(function(event){
                    $("#lessonContainer").children().last().remove();
                    lessonCount--;
                    console.log("Remove Lesson "+ lessonCount);
                    if(lessonCount < 1){
                        lessonCount = 1;
                    }
                });
        });
    </script>


@endsection
