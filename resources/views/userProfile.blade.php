@extends('layouts.app')

<style>
    body{
        background-color:lightgray;
    }

    #back-btn{
        position: absolute;
        right: 15px;
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
                                <div class="col-md-4">
                                    <a href="/users/add/{{$user->id}}" id="Message_user" class="btn btn-outline-success">Send Message to User</a>
                                    <br><hr><br>
                                    <h5> {{$user->email}}</h5>
                                </div>
                                @endif
                            <div class="col-md-4">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary" id="back-btn">Back</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
