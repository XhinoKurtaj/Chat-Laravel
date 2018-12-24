@extends('layouts.app')

@section('content')
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
                                <div class="col-8"><li>{{$conversation->custom_name}}</li></div>
                                <div class="col-4">
                                    <a href="{{ route('message.show', $conversation->id) }}" class="btn btn-outline-success">Join</a>
                                    <a href="{{ route('conversation.delete', $conversation->id) }}"  class="btn btn-outline-danger" >Delete</a>
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
                <div class="card-header"><img src="{{ asset('/images/test.jpeg') }}" alt="Avatar" id="photo_pic"></div>
                <div class="card-body">
                    <h6>{{Auth::user()->first_name}}  {{Auth::user()->last_name}}</h6>
                </div>
            </div><br>
            <form action="{{ route('conversation.store') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter Conversation Name" name="conv" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-sm btn-outline-secondary" value="Create Conversation" id="button-addon2">
                    </div>
                </div>
            </form>
        </div>
</div>
@endsection




