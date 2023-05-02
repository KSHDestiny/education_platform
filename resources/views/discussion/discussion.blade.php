<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discussion</title>
    <link rel="icon" href="{{ asset('asset1/images/diamond.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('asset/custom.css') }}">
    <style>
        .box-shadow{
            box-shadow: 0 0 15px #000000;
            border: 1px solid white;
        }

        .width{
            width: 500px;
        }

        .vh-70 {
            height: 70vh;
        }

        .bg{
            background: #000000 url("{{ asset('asset1/images/bg.jpg') }}") no-repeat;
            background-position: center;
            background-size: cover;
        }

        @media(max-width: 768px){
            .width{
                width: 300px;
            }
        }
    </style>
</head>
<body class="bg container d-flex align-items-center vh-100">
            <div class="card w-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    @if (Auth::user()->role != "student")
                        <a href="{{ route('admin#discussionPage') }}" class="btn btn-outline-danger">Back</a>
                    @else
                        <a href="{{ route('student#discussionPage') }}" class="btn btn-outline-danger">Back</a>
                    @endif
                    <h6>{{ $course->course_title }} Discussion Group</h6>
                    <div class="">
                        @if (Auth::user()->role != "student")
                            <form action="{{ route('deleteMessages',[$course->chat_id]) }}" method="POST">
                                @csrf
                                <input type="submit" name="" class="btn btn-danger" value="Clear all Messages">
                            </form>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <div class="text-center" id="loading">
                        <img src="{{ asset('asset/loading.gif') }}" alt="" width="100px">
                    </div>
                    <div id="seeMoreField">
                        @if (count($discussions) > 6)
                            <span id="seeMore"><a href="#" class="d-block text-center">See more</a></span>
                        @endif
                    </div>

                    {{-- ajax body message --}}
                    <div id="msg-body">
                        @if (count($discussions) < 1)
                        <h4 class="text-danger vh-70 d-flex align-items-center justify-content-center">There is no messages.</h4>
                        @else

                            @for ($i = 0; $i < count($discussions); $i++)

                                @php
                                    if($discussions[$i]->profile == null && $discussions[$i]->gender != "male" && $discussions[$i]->gender != "female"){
                                        $discussions[$i]->profile = "unknown_male.png";
                                    }else if($discussions[$i]->profile == null && $discussions[$i]->gender == "male"){
                                        $discussions[$i]->profile = "unknown_male.png";
                                    }else if($discussions[$i]->profile == null && $discussions[$i]->gender == "female"){
                                        $discussions[$i]->profile = "unknown_female.png";
                                    }
                                @endphp

                                @if ($discussions[$i]->user_id == Auth::user()->id && $discussions[$i]->role == "student")
                                    <div class="msg-item me">
                                        <img src="{{ asset('storage/students/'.$discussions[$i]->profile) }}" class="rounded-circle img-responsive msg-item-img" alt="">
                                        <div class="msg-item-txt">
                                            <small class="text-warning float-end">You</small><br>
                                            {{ $discussions[$i]->message }}
                                            <div class="msg-item-data">
                                                {{ $createdAt[$i] }}
                                                @if ($discussions[$i]->seen == true)
                                                    <i class="fa-solid fa-eye ps-2"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($discussions[$i]->user_id != Auth::user()->id && $discussions[$i]->role == "student")
                                    <div class="msg-item d-flex align-items-end">
                                        <img src="{{ asset('storage/students/'.$discussions[$i]->profile) }}" class="rounded-circle img-responsive msg-item-img" alt="">
                                        <div class="msg-item-txt">
                                            <small class="text-success">{{ $discussions[$i]->name }}</small><br>
                                            {{ $discussions[$i]->message }}
                                            <div class="msg-item-data">
                                                {{ $createdAt[$i] }}
                                                @if ($discussions[$i]->seen == true && Auth::user()->role == "student")
                                                    <i class="fa-solid fa-eye ps-2 text-secondary"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($discussions[$i]->user_id == Auth::user()->id && $discussions[$i]->role != "student")
                                    <div class="msg-item me">
                                        <img src="{{ asset('storage/'.$discussions[$i]->profile) }}" class="rounded-circle img-responsive msg-item-img" alt="">
                                        <div class="msg-item-txt">
                                            <small class="text-warning float-end">You</small><br>
                                            {{ $discussions[$i]->message }}
                                            <div class="msg-item-data">
                                                {{ $createdAt[$i] }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="msg-item d-flex align-items-end">
                                        <img src="{{ asset('storage/'.$discussions[$i]->profile) }}" class="rounded-circle img-responsive msg-item-img" alt="">
                                        <div class="msg-item-txt-prof bg-warning">
                                            <small class="text-danger">Prof.{{ $discussions[$i]->name }}</small><br>
                                            {{ $discussions[$i]->message }}
                                            <div class="msg-item-data">
                                                {{ $createdAt[$i] }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endfor
                        @endif
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <input type="hidden" id="chatId" value="{{ $course->chat_id }}">
                        <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                        <textarea name="" cols="30" rows="2" placeholder="Write a message..." class="form-control" id="message"></textarea>
                        {{-- <input type="text" id="message"> --}}
                        <button class="ms-3 btn btn-outline-success" id="messageSend">Send</button>
                    </div>
                </div>
            </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('asset3/js/jquery.min.js') }}"></script>
<script type="application/javascript">

    $(document).ready(function(){
        var limit = 7;
        var chatId = $('#chatId').val();
        var userId = $('#userId').val();
        setInterval(seeMessage, 3000);

        $('#loading').hide();

        // send btn mute and active
        setInterval(function(){
            if($('#message').val().length < 1){
                $( "#messageSend" ).prop( "disabled", true );
                $( "#messageSend" ).removeClass("btn-outline-success");
                $( "#messageSend" ).addClass("bg-muted");
            }else {
                $( "#messageSend" ).prop( "disabled", false );
                $( "#messageSend" ).removeClass("bg-muted");
                $( "#messageSend" ).addClass("btn-outline-success");
            }
        },500);

        // --- send message part ---
        // send message click btn
        $('#messageSend').click(function(){
            var message = $('#message').val();

            setTimeout(sendMessages(message, chatId, userId), 3000);
        })

        // send message enter key
        $('#message').on('keydown', function(e) {
                    if (e.keyCode == 13) {
                        // apply search btn function
                        $('#messageSend').click();
                    }
        });

        // create discussion message
        function sendMessages(message, chatId, userId){

            $.ajax({
                type: 'post',
                url: '/api/discussionMessage',
                data: {
                    'message' : message,
                    'chatId' : chatId,
                    'userId' : userId,
                },
                dataType: 'json',
                success: function(response){
                    $('#message').val("");
                }
            })
        }

        // --- see message part ---
        // see more click btn
        $('#seeMore').click(function(){
            $('#seeMore').hide();
            $('#loading').show();
            limit += 7;
            setTimeout(seeMoreMessages, 1000);
        })

        // see more message
        function seeMoreMessages(){
            $('#loading').hide();
            $('#seeMore').show();

            // console.log(chatId);
            // console.log(userId);
            // console.log(limit);

            ajaxMessage();
        }

        // see message
        function seeMessage(){
            setTimeout(ajaxMessage,2000);
        }

        // ajaxMessage
        var ajaxMessage = function(){
            // console.log(chatId);
            // console.log(userId);
            // console.log(limit);
            $.ajax({
                type: 'post',
                url: '/api/seeMoreMessage',
                data: {
                    'chatId' : chatId,
                    'userId' : userId,
                    'limit' : limit,
                },
                dataType: 'json',
                success: function(response){
                    // console.log(response);
                    // console.log(response.unseen);

                    if(response.maxCount == 8){
                        setTimeout(function(){
                            location.reload(true);
                        },30000);
                    }

                    if(response.limit > response.maxCount){
                        $('#seeMore').hide();
                    }

                    $("#msg-body").empty();
                    var bodyMsg = ``;
                    if(response.discussions.length < 1){
                        bodyMsg += `<h4 class="text-danger vh-70 d-flex align-items-center justify-content-center">There is no messages.</h4>`;
                    }

                    for(var i = 0; i < response.discussions.length; i++){
                        var discussions = response.discussions[i];
                        var created_at = response.created_at[i];
                        // console.log(discussions);
                        // console.log(response.me);

                        if(discussions.profile == null && discussions.gender != "male" && discussions.gender != "female"){
                            discussions.profile = "unknown_male.png";
                        }else if(discussions.profile == null && discussions.gender == "male"){
                            discussions.profile = "unknown_male.png";
                        }else if(discussions.profile == null && discussions.gender == "female"){
                            discussions.profile = "unknown_female.png";
                        }
                        // <i class="fa-solid fa-eye" style="color: #006eff;"></i>
                        if (discussions.user_id == response.me && discussions.role == "student") {
                            bodyMsg += `<div class="msg-item me">
                                        <img src="{{ asset('storage/students/${discussions.profile}') }}" class="rounded-circle img-responsive msg-item-img" alt="">
                                        <div class="msg-item-txt">
                                            <small class="text-warning float-end">You</small><br>
                                            ${discussions.message}
                                            <div class="msg-item-data">
                                                ${created_at}
                                        `;

                            if(discussions.seen == true){
                                bodyMsg += `<i class="fa-solid fa-eye ps-2"></i>`
                            }

                            bodyMsg +=`</div></div></div>`;

                        } else if (discussions.user_id != response.me && discussions.role == "student") {
                            bodyMsg += `<div class="msg-item d-flex align-items-end">
                                    <img src="{{ asset('storage/students/${discussions.profile}') }}" class="rounded-circle img-responsive msg-item-img" alt="">
                                    <div class="msg-item-txt">
                                        <small class="text-success">${discussions.name}</small><br>
                                        ${discussions.message}
                                        <div class="msg-item-data">
                                            ${created_at}
                                            `;

                            if(discussions.seen == true && response.professorId == null){
                                bodyMsg += `<i class="fa-solid fa-eye ps-2 text-secondary"></i>`
                            }

                            bodyMsg +=`</div></div></div>`;

                        } else if (discussions.user_id == response.me && discussions.role != "student") {
                            bodyMsg += `<div class="msg-item me">
                                        <img src="{{ asset('storage/${discussions.profile}') }}" class="rounded-circle img-responsive msg-item-img" alt="">
                                        <div class="msg-item-txt">
                                            <small class="text-warning float-end">You</small><br>
                                            ${discussions.message}
                                            <div class="msg-item-data">
                                                ${created_at}
                                            </div>
                                        </div>
                                    </div>`;
                        } else if (discussions.user_id != response.me && discussions.role != "student") {
                            bodyMsg += `<div class="msg-item d-flex align-items-end">
                                    <img src="{{ asset('storage/${discussions.profile}') }}" class="rounded-circle img-responsive msg-item-img" alt="">
                                    <div class="msg-item-txt-prof bg-warning">
                                        <small class="text-danger">Prof.${discussions.name}</small><br>
                                        ${discussions.message}
                                        <div class="msg-item-data">
                                            ${created_at}
                                        </div>
                                    </div>
                                </div>`;
                        }
                    }

                    $("#msg-body").html(bodyMsg);
                }
            })
        }
    })
</script>
</html>
