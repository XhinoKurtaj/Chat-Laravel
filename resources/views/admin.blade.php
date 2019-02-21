@extends('adminlte::page')
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<style>
    .size{
        font-size: 17px;
        font-family: "Times New Roman", Times, serif;
        color: black;
    }
    .card-title{
        text-align: center;
        font-size: 60px;
    }
    .card-name{
        text-align: center;
        color:whitesmoke;
        font-family: "Times New Roman", Times, serif;
    }
    /*.name:hover{*/
        /*font-family: "Arial"*/
    /*}*/
</style>
@section('title', 'Admin Panel')

@section('content_header')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card text-white bg-primary mb-3" style="width: 18rem;">
                    <div class="card-body">
                        <h1 class="card-title"><i class="fas fa-users"></i></h1>
                        {{--<a href="/users"></a>--}}
                            <h3 class="card-name name">Users</h3>
                        <h3 class="card-name">{{count($userList)}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-white bg-secondary mb-3" style="width: 18rem;">
                    <div class="card-body">
                        <h1 class="card-title"><i class="fas fa-list-ul"></i></i></h1>
                        {{--<a href="/conversations"></a>--}}
                            <h3 class="card-name name">Conversations</h3>
                        <h3 class="card-name">{{count($conversationList)}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-white bg-success mb-3" style="width: 18rem;">
                    <div class="card-body">
                        <h1 class="card-title"><i class="fas fa-image"></i></h1>
                        {{--<a href="#"></a>--}}
                            <h3 class="card-name name">Photos</h3>
                        <h3 class="card-name name">{{count($photoList)}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-white bg-info mb-3" style="width: 18rem;">
                    <div class="card-body">
                        <h1 class="card-title"><i class="fas fa-envelope"></i></h1>
                        {{--<a href="#"></a>--}}
                        <h3 class="card-name name">Messages</h3>
                        <h3 class="card-name name">{{count($messageList)}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card  text-white bg-danger mb-3" style="width: 18rem;">
                    <div class="card-body">
                        <h1 class="card-title"><i class="fas fa-paperclip"></i></h1>
                        {{--<a href="#"></a>--}}
                            <h3 class="card-name name">Attachments</h3>
                        <h3 class="card-name">{{count($attachmentList)}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

