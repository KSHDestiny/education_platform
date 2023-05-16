<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TeachingController;
use App\Http\Controllers\Api\DiscussionController;
use App\Http\Controllers\Student\EnrollController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Admin\StudentListController;
use App\Http\Controllers\IntroductionController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/intro/dashboard',[IntroductionController::class,'home'])->name('home');


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

    // dashboard
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    // Admin
    Route::group(['prefix'=>'admin','middleware'=>'user_auth_middleware'],function(){

        // admin dashboard
        Route::get('/',[UserController::class,'professorPage'])->name('admin#dashboard');

        // founder edit page
        Route::get('/founder/editPage',[UserController::class,"founderEditPage"])->name("founder#editPage")->middleware('professor_middleware');
        // founder edit
        Route::post('/founder/edit/{id}',[UserController::class,"founderEdit"])->name("founder#edit");

        // professors
        Route::prefix('/professor')->group(function(){
            // professor create
            Route::post('/create',[UserController::class,"professorCreate"])->name("professor#create");
            // professor edit page
            Route::get('/editPage/{id}',[UserController::class,"professorEditPage"])->name("professor#editPage");
            // professor edit
            Route::post('/edit/{id}',[UserController::class,"professorEdit"])->name("professor#edit");
            // professor delete page
            Route::get('/deletePage/{id}',[UserController::class,"professorDeletePage"])->name("professor#deletePage");
            // professor delete
            Route::post('/delete/{id}',[UserController::class,"professorDelete"])->name('professor#delete');
        });

        // view profile page
        Route::get('/myProfile/{id}',[UserController::class,"myProfile"])->name("myProfile");

        // change password
        Route::post('/myProfile/changePassword',[UserController::class,"changePassword"])->name("admin#changePassword");

        // categories
        Route::prefix('/categories')->group(function(){
            // category page
            Route::get('/',[CategoryController::class,'categoryPage'])->name('category#page');
            // category create
            Route::post('/create',[CategoryController::class,'categoryCreate'])->name('category#create');
            // category edit page
            Route::get('/editPage/{id}',[CategoryController::class,'categoryEditPage'])->name('category#editPage');
            // category edit
            Route::post('/edit/{id}',[CategoryController::class,'categoryEdit'])->name('category#edit');
            // category delete page
            Route::get('/deletePage/{id}',[CategoryController::class,'categoryDeletePage'])->name('catagory#deletePage');
            // category delete
            Route::post('/delete/{id}',[CategoryController::class,'categoryDelete'])->name('category#delete');
        });

        // courses
        Route::prefix('/courses')->group(function(){
            // course page
            Route::get('/',[CourseController::class,'coursePage'])->name('course#page');
            // course create
            Route::post('/create',[CourseController::class,'courseCreate'])->name('course#create');
            // course edit page
            Route::get('/editPage/{id}',[CourseController::class,'courseEditPage'])->name('course#editPage');
            // course edit
            Route::post('/edit/{id}',[CourseController::class,'courseEdit'])->name('course#edit');
            // course delete page
            Route::get('/deletePage/{id}',[CourseController::class,'courseDeletePage'])->name('course#deletePage');
            // course delete
            Route::post('/delete/{id}',[CourseController::class,'courseDelete'])->name('course#delete');
        });

        // lessons
        Route::prefix('/courses/lessons')->group(function(){
            // lesson page
            Route::get('/{id}',[LessonController::class,'lessonPage'])->name('lesson#page');
            // lesson create page
            Route::get('/createPage/{id}',[LessonController::class,'lessonCreatePage'])->name('lesson#createPage');
            // lesson create
            Route::post('/create/{id}',[LessonController::class,'lessonCreate'])->name('lesson#create');
            // lesson change page
            Route::get('/changePage/{id}',[LessonController::class,'lessonChangePage'])->name('lesson#changePage');
            // lesson change
            Route::post('/change/{id}',[LessonController::class,'lessonChange'])->name('lesson#change');
        });

        // teaching
        Route::prefix('/teachings')->group(function(){
            // teaching page
            Route::get('/',[TeachingController::class,'teachingPage'])->name('teaching#page');
            // assignment submission
            Route::post('/assignment/{assignment_id}',[TeachingController::class,'assignmentSubmission'])->name('teaching#assignment');
        });

        // student lists
        Route::prefix('/students/lists')->group(function(){
            // student lists page
            Route::get('/',[StudentListController::class,'studentListPage'])->name('admin#studentListpage');
        });

        // admin direct discussion forem
        Route::prefix('/discussion')->group(function(){
            // admin discussion page
            Route::get('/',[DiscussionController::class,'adminDiscussionPage'])->name('admin#discussionPage');
        });
    });

    // Student
    Route::group(['prefix'=>'student','middleware'=>'student_auth_middleware'],function(){
        // student dashboard
        Route::get('/dashboard',[StudentController::class,'studentDashboard'])->name('student#dashboard');
        // profile page
        Route::get('/profile',[StudentController::class,'profilePage'])->name('student#profilePage');
        // profile edit
        Route::post('/profile',[StudentController::class,'profileEdit'])->name('student#profileEdit');
        // change password
        Route::post('/changePassword',[StudentController::class,'changePassword'])->name('student#changePassword');

        // enroll
        Route::prefix('/enroll')->group(function(){
            // enroll course
            Route::get('/{course_id}',[EnrollController::class,'enroll'])->name('student#enroll');
            // enrolled courses page
            Route::get('/enrolled/courses',[EnrollController::class,'enrolledCoursePage'])->name('student#enrolledCoursePage');
            // enrolled course lesson page
            Route::get('/course/lesson/{id}',[EnrollController::class,'courseLessonPage'])->name('student#courseLessonPage');
            // rating
            Route::post('/course/rating/{enroll_id}',[EnrollController::class,'rating'])->name('student#rating');
            // rerating
            Route::get('/course/reRating/{enroll_id}',[EnrollController::class,'reRating'])->name('student#reRate');
            // assignment submission
            Route::post('/assignment/{course_id}',[EnrollController::class,'courseAssignment'])->name('student#courseAssignment');
            // assignment resubmit
            Route::get('/assignment/resubmit/{assignment_id}',[EnrollController::class,'assignmentResubmit'])->name('student#assignmentResubmit');
            // achievement
            Route::get('/achievement/qualify',[EnrollController::class,'achievement'])->name('student#achievement');
            // achievement course page
            Route::get('/achievement/course/{course_id}',[EnrollController::class,'achievementCourse'])->name('student#achievementCourse');
            // rate course
            // Route::post('/rateCourse/{enroll_id}',[EnrollController::class,'rateCourse'])->name('student#rateCourse');
        });

        // student direct discussion forem
        Route::prefix('/discussion')->group(function(){
            // student discussion page
            Route::get('/',[DiscussionController::class,'studentDiscussionPage'])->name('student#discussionPage');
        });
    });

    // discussion forem
    Route::prefix('/discussion')->group(function(){
        // direct discussion page
        Route::get('/{chat_id}',[DiscussionController::class,'discussionPage'])->name('discussionPage');
        // delete all messages
        Route::post('/{chat_id}',[DiscussionController::class,'deleteMessages'])->name('deleteMessages');
    });
});
