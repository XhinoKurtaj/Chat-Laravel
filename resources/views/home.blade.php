@extends('layouts.app')
<style>
    #conversation-group{
        width: 100px;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;

    }
    #conversation-group:hover{
        width: 185px;
        overflow: visible;
    }
    .profile-redirect{
        color: black;
    }
    .conversation-wrapper-scroll-y {
        display: block;
        max-height: 550px;
        overflow-y: auto;
        overflow-x: hidden;
    }

</style>
@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    @if (Session::has('success-delete'))
        <div class="alert alert-success">
            <ul>
                <li>{!! Session::get('success-delete') !!}</li>
            </ul>
        </div>
    @endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><i class="fas fa-list-alt"></i> Conversation List</div>
                <div class="card-body">
                        @if(empty($conversationList))
                            <li>You dont have any conversation</li>
                        @else
                        <div class="conversation-wrapper-scroll-y">
                        @foreach($conversationList as $conversation)
                            <div class="row" >
                                <div class="col-8">
                                   <a href="{{ route('message.show', $conversation->id) }}" class="button-conv"><img src="/storage/{{ $conversation->custom_photo }}" style="width:32px; height:32px;  top:10px; left:10px; border-radius:50%">
                                    {{$conversation->custom_name}}
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ route('show.conversation', $conversation->id)}}"  class="btn btn-outline-success btn-sm" ><i class="fas fa-edit"></i> Edit</a>
                                    <a onclick="return confirm('Are you sure u want to delete this conversation?')" href="{{ route('conversation.delete', $conversation->id) }}"  class="btn btn-outline-danger btn-sm" ><i class="far fa-trash-alt"> Delete</i></a>
                                </div>
                            </div><hr>
                        @endforeach
                        </div>
                        @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><img src="/storage/{{ Auth::user()->photo }}" alt="Avatar" id="photo_pic" style="width:200px;height:200px;"></div>
                <div class="card-body">
                    <h5><a href="{{ url('/profile') }}" class="profile-redirect"><i class="fa fa-btn fa-user"></i> {{Auth::user()->fullName}}</a></h5>
                    <h5 style="text-align: right;"><a>{{Auth::user()->email}}</a></h5>
                </div>
            </div><br>
            <form action="{{ route('conversation.store') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter Conversation Name" name="custom_name" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        {{--<input type="submit" class="btn btn-sm btn-outline-secondary" value="Create Group Conversation" id="button-addon2">--}}
                        <button type="submit" class="btn btn-sm btn-outline-secondary " id="conversation-group"><i class="fas fa-users"></i> Create Group Conversation</button>
                    </div>
                </div>
            </form><hr>
            <div class="input-group-append">
                <a href='{{route('data.table')}}' class="btn btn-outline-secondary btn-lg" type="button" id="button-addon2"><i class="fas fa-search"></i> Search for users</a>
            </div>

        </div>
    </div>
</div>
@endsection




