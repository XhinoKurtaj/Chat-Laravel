@extends('layouts.app')

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
                <div class="card-header">Conversation List</div>
                <div class="card-body">
                        @if(empty($conversationList))
                            <li>You dont have any conversation</li>
                        @else
                        @foreach($conversationList as $conversation)
                            <div class="row">
                                <div class="col-8">
                                   <a href="{{ route('message.show', $conversation->id) }}" class="button-conv"><img src="/storage/{{ $conversation->custom_photo }}" style="width:32px; height:32px;  top:10px; left:10px; border-radius:50%">
                                    {{$conversation->custom_name}}
                                    </a>
                                </div>
                                <div class="col-4">
                                    {{--<a href="{{ route('message.show', $conversation->id) }}" class="btn btn-outline-success">Join</a>--}}
                                    <a href="{{ route('show.conversation', $conversation->id)}}"  class="btn btn-outline-success" >Edit</a>
                                    <a onclick="return confirm('Are you sure u want to delete this conversation?')" href="{{ route('conversation.delete', $conversation->id) }}"  class="btn btn-outline-danger" >Delete</a>
                                </div>
                            </div><hr>
                        @endforeach
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
                    <h5>{{Auth::user()->fullName}}</h5>
                    <h5 style="text-align: right;">{{Auth::user()->email}} </h5>
                </div>
            </div><br>
            <form action="{{ route('conversation.store') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter Conversation Name" name="custom_name" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-sm btn-outline-secondary" value="Create Group Conversation" id="button-addon2">
                    </div>
                </div>
            </form>
            <div class="input-group-append">
                <a href='{{route('data.table')}}' class="btn btn-outline-secondary btn-lg" type="button" id="button-addon2">Search for users</a>
            </div>

        </div>
    </div>
</div>
@endsection




