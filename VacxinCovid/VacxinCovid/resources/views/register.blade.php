<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/css/bootstrap.min.css') }}">
    <style>
        .formRegister {
            width: 450px;
            margin: auto;
            padding: 30px 0px;
            font-size: 15px;
        }
        .formRegister a {
            text-decoration: none;
        }
        .footer {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="formRegister">
            <div class="tittle">
                <h2>Register</h2>
                <p>Create your account. It's free and only takes a minute.</p>
            </div>

            <div class="content">
                <form action="{{ url('/register') }}" method="POST">               
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="identify" placeholder="Số CMND" name="identify"/>
                        @error('identify')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="name" placeholder="Họ Và Tên" name="name"/>
                        @error('name')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

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
                        <input type="date" class="form-control" id="dob" placeholder="Ngày Tháng Năm Sinh" name="dob"/>
                        @error('dob')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="address" placeholder="Địa Chỉ" name="address"/>
                        @error('address')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" id="telephone" placeholder="Số Điện Thoại" name="telephone"/>
                        @error('telephone')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="allegry" placeholder="Tiền Sử Dị Ứng" name="allegry"/>
                        @error('allegry')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block" name="register">Register Now</button>
                    </div>
                </form>
            </div>

            <div class="footer">
                <span>Already have an account ? <a href="{{ url('/login') }}">Sign In</a></span>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendors/jquery/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>