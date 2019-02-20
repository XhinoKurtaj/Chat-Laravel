@extends('layouts.app')

<style>
    body{
        background-color:lightgray;
    }

    #back-btn{
        position: absolute;
        right: 15px;
    }
    .wrapp-comments{
        border: 0.5px solid black;
    }

</style>

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 align-self-end">
                <div class="card">
                    <div class="card-header"><h2> {{$user->fullName}}'s Profile</h2></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="/storage/{{$user->photo}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                            </div>
                            @if($user->id == auth()->user()->id)
                                <div class="col-md-4">
                                    <a href="{{route("user.profile")}}" id="user_profile" class="btn btn-outline-success">Go to profile</a>
                                    <br><hr><br>
                                    <h5> {{$user->email}}</h5>
                                </div>
                                @else
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="/users/add/{{$user->id}}" id="Message_user" class="btn btn-outline-success btn-sm">
                                            <i class="fas fa-comment-alt"></i> Send Message to User</a>
                                        </div>
                                        <div class="col-6"><h5> {{$user->email}}</h5></div>
                                    </div>
                                    <br><hr><br>
                                </div>
                                @endif
                            <div class="col-md-3">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary" id="back-btn"><i class="fas fa-arrow-circle-left"></i> Back</a>
                                <input id="user" type="hidden" value="{{$user->id}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
