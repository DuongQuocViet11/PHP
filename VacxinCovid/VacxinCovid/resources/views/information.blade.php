<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All User</title>
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container">
        <h1 align="center">Thông Tin Tài Khoản</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Tên</th>
                <th scope="col">Email</th>
                <th scope="col">Identify</th>
                <th scope="col">DOB</th>
                <th scope="col">Address</th>
                <th scope="col">Telephone</th>
                <th scope="col">Allegry</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->identify }}</td>
                    <td>{{ $user->dob }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->telephone }}</td>
                    <td>{{ $user->allegry }}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>

          <a href="{{ url('logout') }}">
            <button type="button" class="btn btn-danger">Log Out</button>
          </a>
    </div>

    <script src="{{ asset('vendors/jquery/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>