<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\DiscussionController;
use App\Http\Controllers\Api\StudentListController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// course sorting
Route::post('/course/sorting',[CourseController::class,'courseSorting'])->name('api#courseSorting');

// student lists
Route::post('/studentList',[StudentListController::class,'studentList'])->name('api#studentList');

// student detail
Route::post('/studentDetail',[StudentListController::class,'studentDetail'])->name('api#studentDetail');

// discussion noti
Route::get('/discussionNotification',[DiscussionController::class,'discussionNotification'])->name('api#discussionNotification');

// discussion message
Route::post('/discussionMessage',[DiscussionController::class,'discussionMessage'])->name('api#discussionMessage');

// see messages
Route::post('/seeMoreMessage',[DiscussionController::class,'seeMessages'])->name('api#seeMessages');
