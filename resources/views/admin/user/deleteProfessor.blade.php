<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="icon" href="{{ asset('asset1/images/diamond.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        .box-shadow{
            box-shadow: 0 0 15px #000000;
            border: 1px solid white;
        }

        .width{
            width: 500px;
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
<body class="bg">
    <div class="position-relative vh-100">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="card bg-black box-shadow width">
                <div class="card-header mx-auto bg-black">
                    <a href="#"><img src="{{ asset('asset1/images/logo.png') }}" alt=""></a>
                </div>
                <div class="card-body">
                    <form action="{{ route('professor#delete',[$user->id]) }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <b class="text-danger">Are you sure that @if (Auth::user()->role == "founder")
                                Prof.{{ $user->name }}
                            @else
                                you
                            @endif will leave / retire from Education Platform?</b>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('admin#dashboard') }}" class="btn btn-dark">Back</a>
                            <input type="submit" class="btn btn-light" value="Sure">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>
