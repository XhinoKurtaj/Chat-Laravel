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
    @if(auth()->user()->type == "admin")
    <div class="container-fluid">
        @else
            <div class="container">
            @endif
        <div class="row">
            <div class="col-12 align-self-end">
                <div class="card">
                    <div class="card-header"><h2> {{$user[0]->fullName}}'s Profile</h2></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="/storage/{{$user[0]->photo}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                            </div>
                            @if($user[0]->id == auth()->user()->id)
                                <div class="col-md-4">
                                    <a href="{{route("user.profile")}}" id="user_profile" class="btn btn-outline-success">Go to profile</a>
                                    <br><hr><br>
                                    <h5> {{$user[0]->email}}</h5>
                                </div>
                                @else
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="/users/add/{{$user[0]->id}}" id="Message_user" class="btn btn-outline-success btn-sm">
                                            <i class="fas fa-comment-alt"></i> Send Message to User</a>
                                        </div>
                                        <div class="col-6"><h5> {{$user[0]->email}}</h5></div>
                                    </div>
                                </div>
                                @endif
                            <div class="col-md-3">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary" id="back-btn"><i class="fas fa-arrow-circle-left"></i> Back</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
