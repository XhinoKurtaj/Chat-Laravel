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
                        @if(auth()->user()->type == "admin")
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-1">
                                    <a href="/profile/{{$user[0]->id}}/delete" onclick="return confirm('Are you sure u want to delete this User?')" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Delete User</a>
                                </div>
                                <div class="col-8">
                                    <h5>Photos <i class="fas fa-image"></i></h5>
                                    <div class="table-wrapper-scroll-y">
                                        <div class="row" >
                                            <div class="column">
                                            @foreach($user[0]->photos as $photo)
                                                    <a href="/photos/{{$photo->id}}"><img src="/storage/{{$photo->photo}}" class='img-thumbnail'></a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">

                                    <form method="POST" action="{{ route('user.update') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="First Name" class="col-md-4 col-form-label text-md-right">{{ __('First_name') }}</label>

                                            <div class="col-md-6">
                                                <input id="First Name" type="text" class="form-control{{ $errors->has('First_name') ? ' is-invalid' : '' }}" name="first_name" placeholder="{{$user[0]->first_name}}" value="{{$user[0]->first_name}}" autofocus>

                                                @if ($errors->has('First_name'))
                                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('First_name') }}</strong>
                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Last Name" class="col-md-4 col-form-label text-md-right">{{ __('Last_name') }}</label>

                                            <div class="col-md-6">
                                                <input id="Last Name" type="text" class="form-control{{ $errors->has('Last_name') ? ' is-invalid' : '' }}" name="last_name" placeholder="{{$user[0]->last_name}}" value="{{$user[0]->last_name}}" autofocus>

                                                @if ($errors->has('Last_name'))
                                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Last_name') }}</strong>
                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{$user[0]->id}}" name="user_id">
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i>
                                                    {{ __('Update') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
