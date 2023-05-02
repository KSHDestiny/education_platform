@extends('admin.layouts.master')

@section('title')
    <title>Students' Lists Page</title>
    <style>
        .table-row {
            cursor: pointer;
        }

        .table-row:hover {
            color:blue
        }
    </style>
@endsection

@section('header')
    <header id="header">
        <a href="#" class="logo">Education Platform</a>
        <h3 class="mt-3">Students' Lists</h3>
    </header>
@endsection

@section('navbar')
    <ul class="links">
        <li><a href="{{ route('admin#dashboard') }}">Professors</a></li>
        <li><a href="{{ route('category#page') }}">Categories</a></li>
        <li><a href="{{ route('course#page') }}">Courses</a></li>
        <li><a href="{{ route('teaching#page') }}">Teachings</a></li>
        <li class="active"><a href="{{ route('admin#studentListpage') }}">Students' Lists</a></li>
    </ul>
@endsection

@section('body')
    <div id="footer">
        <table class="table">
            <input type="hidden" id="professorId" value="{{ Auth::user()->id }}">
            <thead>
                <tr id="moreDetail">

                </tr>
                <tr>
                    <th class="col-2">
                        <select name="studentOption" id="studentOption" class="form-select">
                            <option value="all" selected>All</option>
                            <option value="myStudents">My Students</option>
                        </select>
                    </th>
                    <th class="col-2"></th>
                    <th colspan="2" class="col-8">
                        <div class="d-flex">
                            <input type="text" id="searchKey" placeholder="Search...">
                            <button class="btn btn-primary" id="searchBtn">Search</button>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th class="col-1">No</th>
                    <th class="col-3">Name</th>
                    <th class="col-4">Email</th>
                    <th class="col-4">Phone</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @for ($i = 0; $i < count($students); $i++)
                    <tr onclick="detail({{ $students[$i]->id }})" class="table-row">
                        <td class="col-1">{{ $i+1 }}</td>
                        <td class="col-3">{{ $students[$i]->name }}</td>
                        <td class="col-4">{{ $students[$i]->email }}</td>
                        <td class="col-4">@if ($students[$i]->phone == null)
                            <div class="text-danger">no data</div>
                        @else
                            {{ $students[$i]->phone }}
                        @endif</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endsection

@section('scriptJquery')
    <script type="application/javascript">
        $(document).ready(function(){

            // all & my students
            $('#studentOption').change(function(){
                searching();
            });

            // search students
            $('#searchBtn').click(function(){
                searching();
            })

            // searching function
            function searching(){
                var studentOption = $('#studentOption').val();
                var searchKey = $('#searchKey').val();
                var professorId = $('#professorId').val();

                $("#moreDetail").hide();

                $.ajax({
                    type: 'post',
                    url: '/api/studentList',
                    data: {
                        'option' : studentOption,
                        'key' : searchKey,
                        'professorId' : professorId
                    },
                    dataType: 'json',
                    success: function(response){
                        var students = ``;
                        if(response.students.length < 1){
                                students = `<tr><td colspan="4"><h2 class="text-center mt-5 text-danger">There is no such data.</h2></td></tr>`;
                        }else{
                            for(var i = 0; i < response.students.length; i++){
                                var student = response.students[i];

                                students += `
                                <tr onclick="detail(${ student.id })" class="table-row">
                                    <td class="col-1">${i+1}</td>
                                    <td class="col-3">${student.name}</td>
                                    <td class="col-4">${student.email}</td>
                                    <td class="col-4">`;

                                if (student.phone == null){
                                    students += `<div class="text-danger">no data</div>`;
                                }else{
                                    students += `${student.phone}`
                                };

                                students += `</td></tr>`;
                            }
                        }

                        $('#tbody').html(students);
                    }
                });
            }
        });

        // detail function
        function detail($studentId){
            $("#moreDetail").show();

            $.ajax({
                    type: 'post',
                    url: '/api/studentDetail',
                    data: {
                        'studentId' : $studentId,
                    },
                    dataType: 'json',
                    success: function(response){
                        // console.log(response);

                        var details = ``;

                        var student = response.studentDetail;

                        if(student.education == "md"){
                            student.education = "Master's Degree";
                        }else if(student.education == "scnd"){
                            student.education = "Some college but no degree";
                        }else if(student.education == "ad"){
                            student.education = "Associate Degree";
                        }else if(student.education == "bd"){
                            student.education = "Bachelor's Degree";
                        }else {
                            student.education = "Undergraduate";
                        }

                        // var profile = "";
                        // if(student.profile == null && student.gender == male || student.profile == null && student.gender == null){
                        //     profile = "asset2/images/unknown_male.png";
                        // }else if(student.profile == null && student.gender == female){
                        //     profile = "asset2/images/unknown_female.png";
                        // }else {
                        //     profile = "storage/students/${student.profile}";
                        // }

                        if(student.phone == null){
                            student.phone = "<span class='text-danger'>no data</span>";
                        }

                        if(student.gender == null){
                            student.gender = "<span class='text-danger'>no data</span>";
                        }

                        if(student.age == null){
                            student.age = "<span class='text-danger'>no data</span>";
                        }

                        if(student.profile == null && student.gender != "male" && student.gender != "female"){
                            student.profile = "unknown_male.png";
                        }else if(student.profile == null && student.gender == "male"){
                            student.profile = "unknown_male.png";
                        }else if(student.profile == null && student.gender == "female"){
                            student.profile = "unknown_female.png";
                        }


                        details += `
                        <th colspan="4">
                            <div class="row" style="text-transform: none">
                                <div class="text-center col-4">
                                    <img src="{{ asset('storage/students/${student.profile}') }}" class="" height="100px" alt="">
                                </div>
                                <div class="row col-8">
                                    <ul class="col-6">
                                        <li>Name : ${student.name}</li>
                                        <li>Email : ${student.email}</li>
                                        <li>Phone : ${student.phone}</li>
                                        <li>Gender : ${student.gender}</li>
                                        <li>Age : ${student.age}</li>
                                    </ul>
                                    <ul class="col-6">
                                        <li>Education : ${student.education}</li>
                                        <li>Courses Id :`;

                        for(var i = 0; i < response.courses.length; i++){
                            var courses = response.courses[i];

                            details += ` <span title="${courses.course_title}" class="text-black">${courses.course_id}</span>/ `;
                        }

                        details += `</li><li>Certified Courses Id :`;

                        for(var x = 0; x < response.certifiedCourses.length; x++){
                            var certifiedCourses = response.certifiedCourses[x];
                            details += ` <span title="${certifiedCourses.course_title}" class="text-black">${certifiedCourses.course_id}</span>/ `;
                        }

                        details += `</li></ul></div></div></th>`;

                        $('#moreDetail').html(details);
                    }
                });
        }
    </script>
@endsection
