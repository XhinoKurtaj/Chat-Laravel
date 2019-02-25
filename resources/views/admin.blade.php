@extends('adminlte::page')
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<style>
    .size {
        font-size: 17px;
        font-family: "Times New Roman", Times, serif;
        color: black;
    }

    .card-title {
        text-align: center;
        font-size: 60px;
    }

    .card-name {
        text-align: center;
        color: whitesmoke;
        font-family: "Times New Roman", Times, serif;
    }

    .wrapp-icon{
        padding-top:20px;
    }
</style>
@section('title', 'Admin Panel')

@section('content_header')
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{count($userList)}}</h3>
                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users wrapp-icon"></i>
                </div>
                <a href="/admin/users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{count($conversationList)}}</h3>

                    <p>Conversations</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list-ul wrapp-icon"></i>
                </div>
                <a href="/admin/conversations" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{count($photoList)}}</h3>

                    <p>Photos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-image wrapp-icon"></i>
                </div>
                <a href="/admin/photos" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-light-blue">
                <div class="inner">
                    <h3>{{count($messageList)}}</h3>

                    <p>Messages</p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope wrapp-icon"></i>
                </div>
                <a href="/admin/messages" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{count($attachmentList)}}</h3>

                    <p>Attachments</p>
                </div>
                <div class="icon">
                    <i class="fas fa-paperclip wrapp-icon"></i>
                </div>
                <a href="/admin/attachments" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>
@stop

