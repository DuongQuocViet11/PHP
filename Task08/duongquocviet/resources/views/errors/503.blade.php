<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Be right back</title>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100&display=swap" rel="stylesheet">
        <style>
            html, body{
                height: 100%;
            }

            body{
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container{
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content{
                text-align: center;
                display: inline-block;
            }

            .title{
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Be right back.</div>
                @if(count($errors)>0)
                {{--danh sach loi--}}
                    <div class="alert alert-danger">
                        <strong>ERROR</strong>
                        <br><br>
                        <ul>
                            @foreach($errors->all() as $errors)
                                <li>{{$errors}}</li>
                            @endforeach
                        </ul>
                    @endif
                    </div>
            </div>
        </div>
    </body>
</html>
