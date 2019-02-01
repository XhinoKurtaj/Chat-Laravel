@extends('adminlte::page')
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<style>
    .size{
        font-size: 17px;
        font-family: "Times New Roman", Times, serif;
        color: black;
    }
</style>
@section('title', 'Admin Panel')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6"><h1>Users</h1><hr>
                @foreach($userList as $user)
                    <div class="row">
                        <div class="col-8">
                            <div class='alert alert-dark' role='alert'>
                                <p class='alert-heading'>
                                    <a href="" class="button-conv"><img src="/storage/{{$user->photo}}" style="width:32px; height:32px;  top:10px; left:10px; border-radius:50%">
                                        &nbsp&nbsp<span class="size"><strong>{{$user->fullName}}</strong></span><br>
                                        <span class="size"><strong>{{$user->email}}</strong></span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col-md-6"><h1>Conversations</h1><hr>

                @foreach($conversationList as $conversation)
                    <div class="row alert alert-dark">
                        <div class="col-4">
                            <a href="{{ route('message.show', $conversation->id) }}" class="button-conv"><img src="/storage/{{ $conversation->custom_photo }}" style="width:32px; height:32px;  top:10px; left:10px; border-radius:50%">
                                <span class="size"><strong>{{$conversation->custom_name}}</strong></span>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('show.conversation', $conversation->id)}}"  class="btn btn-outline-success" >Edit</a>
                            <a onclick="return confirm('Are you sure u want to delete this conversation?')" href="{{ route('conversation.delete', $conversation->id) }}"  class="btn btn-outline-danger" >Delete</a>
                        </div>
                    </div><hr>
                @endforeach

            </div>
        </div>
    </div>
@stop

