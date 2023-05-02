<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
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
                    <a href="{{ url('/') }}"><img src="{{ asset('asset1/images/logo.png') }}" alt=""></a>
                </div>
                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="name" name="name" value="{{ old('name') }}" class="form-control" id="floatingInput" placeholder="UserName">
                            <label for="floatingInput">Name</label>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="floatingInput" placeholder="Email@example.com">
                            <label for="floatingInput">Email address</label>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password_confirmation" class="form-control" id="floatingPassword" placeholder="Confirm Password">
                            <label for="floatingPassword">Confirm Password</label>
                            @error('password_confirmation')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('login') }}" class="btn btn-outline-light">Already registered?</a>
                            <input type="submit" class="btn btn-light" value="Register">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>
