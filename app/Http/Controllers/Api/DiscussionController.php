<?php

namespace App\Http\Controllers\Api;

use App\Models\Chat;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    // direct admin discussion page
    public function adminDiscussionPage(){
        $courses = Chat::select('courses.course_title','chats.chat_id')
                ->join('courses','chats.course_id','courses.course_id')
                ->where('professor_id',Auth::user()->id)->get();

        $seens = Discussion::where('seen',false)->get()->groupBy('chat_id');
        $seen = [];
        foreach($seens as $x => $item){
            $seen[] = ['chat_id' => $x, 'seenCount' => count($item)];
        }
        // dd($seen);
        for($i = 0; $i < count($courses); $i++){
            for($x = 0; $x < count($seen); $x++){
                $status = false;
                if($courses[$i]->chat_id == $seen[$x]['chat_id']){
                    if($seen[$x]['seenCount']){
                        $status = true;
                    }
                }

                if($status){
                    $courses[$i]->seenCount = $seen[$x]['seenCount'];
                }
            }
        }
        // dd($courses->toArray());
        return view('admin.discussion.discussion',compact('courses'));
    }

    //  direct student discussion page
    public function studentDiscussionPage(){
        $courses = Course::select('courses.course_title','chats.chat_id','courses.course_image','users.profile')
                ->join('enrolls','courses.course_id','enrolls.course_id')
                ->join('chats','courses.course_id','chats.course_id')
                ->join('users','courses.professor_id','users.id')
                ->where('enrolls.student_id',Auth::user()->id)
                ->get();
        return view('student.user.discussion',compact('courses'));
    }

    // direct discussion page
    public function discussionPage($chat_id){

        // block professors to other professor's course
        $courseProfessorId = Course::select('courses.professor_id')
                    ->join('chats','courses.course_id','chats.course_id')
                    ->where('chats.chat_id',$chat_id)
                    ->first()->professor_id;

        if(Auth::user()->role != "student" && Auth::user()->id != $courseProfessorId){
            abort(403);
        }

        // block students to unrolled course
        $courseStudentId = Enroll::select('enrolls.student_id')
                    ->join('chats','enrolls.course_id','chats.course_id')
                    ->where('chats.chat_id',$chat_id)
                    ->where('enrolls.student_id',Auth::user()->id)
                    ->first();
        // dd($courseStudentId->toArray());

        if(Auth::user()->role == "student" && !$courseStudentId){
            abort(403);
        }


        $course = Course::select('courses.*','chats.chat_id','courses.professor_id')
                    ->join('chats','courses.course_id','chats.course_id')
                    ->join('users','courses.professor_id','users.id')
                    ->where('chats.chat_id',$chat_id)
                    ->first();

        $discussions = Discussion::select('discussions.*','users.name','users.profile','users.gender','users.role')
                        ->join('users','discussions.user_id','users.id')
                        ->where('discussions.chat_id',$chat_id)
                        ->orderBy('created_at','asc')
                        ->get();

        if (count($discussions) > 7) {
            $discussions = Discussion::select('discussions.*','users.name','users.profile','users.gender','users.role')
                                        ->join('users','discussions.user_id','users.id')
                                        ->where('discussions.chat_id',$chat_id)
                                        ->take(7)->skip(count($discussions) - 7)
                                        ->orderBy('created_at','asc')
                                        ->get();
        }

        if(Auth::user()->role != "student" && Auth::user()->id == $course->professor_id){
            $data = ['seen' => true];
            Discussion::where('chat_id',$chat_id)->update($data);
        }

        $createdAt = [];

        for($i = 0; $i < count($discussions); $i++){
            if($discussions[$i]->created_at->diffInHours(Carbon::now(), false) > 24 ){
                $createdAt[] = $discussions[$i]->created_at->format('d F Y h:i A');
            }else {
                $createdAt[] = $discussions[$i]->created_at->diffForHumans();
            }
        }

        return view('discussion.discussion',compact('course','discussions','createdAt'));
    }

    // delete all messages
    public function deleteMessages($chat_id){
        Discussion::where('chat_id',$chat_id)->delete();
        return back();
    }

    // API
    // discussion notification
    public function discussionNotification(Request $request){
        $unseenCourses = Chat::select('courses.course_title', DB::raw('count(discussions.seen) as unseen'))
                    ->join('courses','chats.course_id','courses.course_id')
                    ->join('discussions','chats.chat_id','discussions.chat_id')
                    ->where('courses.professor_id',$request->professorId)
                    ->where('discussions.seen',false)
                    ->groupBy('courses.course_title')
                    ->get();

        $courses = Chat::select('courses.course_title')
                    ->join('courses','chats.course_id','courses.course_id')
                    ->where('courses.professor_id',$request->professorId)
                    ->groupBy('courses.course_title')
                    ->orderBy('courses.course_id')
                    ->get();

        $chatIds = Chat::select('courses.course_title','chats.chat_id')
                    ->join('courses','chats.course_id','courses.course_id')
                    ->where('courses.professor_id',$request->professorId)
                    ->get();


        foreach($courses as $course){
            $status = false;
            $unseen = '';
            $id = '';
            foreach($unseenCourses as $unseenCourse){
                if($course->course_title == $unseenCourse->course_title){
                    $status = true;
                    $unseen = $unseenCourse->unseen;
                }
            }

            foreach($chatIds as $chatId){
                if($course->course_title == $chatId->course_title){
                    $id = $chatId->chat_id;
                }
            }

            if($status){
                $allCourses[] = ['course_title' => $course->course_title, 'unseen' => $unseen, 'chat_id' => $id];
            }else{
                $allCourses[] = ['course_title' => $course->course_title, 'unseen' => 0, 'chat_id' => $id];
            }
        }


        $data = [
            'allCourses' => $allCourses,
        ];

        // logger($allCourses);

        return response()->json($data, 200);
    }


    // discussion message
    public function discussionMessage(Request $request){
        $data = [
            'message' => $request->message,
            'chat_id' => $request->chatId,
            'user_id' => $request->userId
        ];
        Discussion::create($data);

        return response()->json(["successMessage" => "Message is created successfully."], 200);
    }

    // seeMessages
    public function seeMessages(Request $request){
        $discussions = Discussion::select('discussions.*','users.name','users.profile','users.gender','users.role')
        ->join('users','discussions.user_id','users.id')
        ->where('discussions.chat_id',$request->chatId)
        ->orderBy('created_at','asc')
        ->get();

        $professor = Course::select('users.id')
                        ->join('users','courses.professor_id','users.id')
                        ->where('courses.professor_id',$request->userId)
                        ->first();

        if($professor){
            $data = ['seen' => true];
            Discussion::where('chat_id',$request->chatId)->update($data);
        }

        $maxCount = count($discussions);

        if (count($discussions) > $request->limit) {
        $discussions = Discussion::select('discussions.*','users.name','users.profile','users.gender','users.role')
                                ->join('users','discussions.user_id','users.id')
                                ->where('discussions.chat_id',$request->chatId)
                                ->take($request->limit)->skip(count($discussions) - $request->limit)
                                ->orderBy('created_at','asc')
                                ->get();
        }

        if (count($discussions) > 0){
            for($i = 0; $i < count($discussions); $i++){
                if($discussions[$i]->created_at->diffInHours(Carbon::now(), false) > 24 ){
                    $created_at[] = $discussions[$i]->created_at->format('d F Y h:i A');
                }else {
                    $created_at[] = $discussions[$i]->created_at->diffForHumans();
                }
            }
        } else {
            $created_at = "";
        }

        $unseen = Discussion::where('seen',false)->get();

        $response = [
            'discussions' => $discussions,
            'me' => $request->userId,
            'created_at' => $created_at,
            'limit' => $request->limit,
            'maxCount' => $maxCount,
            'unseen' => $unseen,
            'professorId' => $professor
        ];

        return response()->json($response, 200);
    }
}
