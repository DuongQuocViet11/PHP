<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/css/bootstrap.min.css') }}">
    <style>
        .formLogin {
            padding: 30px 0px;
        }
        .tittle h2 {
            font-size: 40px;
        }
        .content {
            padding: 20px 0px;
        }
        .note {
            text-align: center;
        }
        .note span {
            font-size: 20px;
        }
        .note span a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="formLogin">
            <div class="tittle">
                <h2>Login</h2>
            </div>
         
            <div class="content">
                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" placeholder="Email" name="email"/>  
                        @error('email')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror  
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" id="password" placeholder="Mật Khẩu" name="password"/>    
                        @error('password')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block" name="login">Login</button>
                    </div>
                </form>
            </div>

            <div class="note">
                <span>Don't have an account ? <a href="{{ url('/register') }}">Register</a></span>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendors/jquery/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>