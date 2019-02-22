@extends('adminlte::page')

<style>
    body{
        background-color:lightgray;
    }

    #back-btn{
        position: absolute;
        right: 15px;
    }

    .table-wrapper-scroll-y {
        display: block;
        max-height: 370px;
        overflow-y: auto;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }

    .image{
        height: 200px;
        width: 200px;
        padding: 5px;
    }

    #conversation-list{
        overflow: auto;
        height: 370px;
        background: whitesmoke;
    }
    #style-a{
        color:black;
        text-decoration: none;
    }
    #style-a:hover{color:blue}
</style>

@section('content-users-details')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2> {{$userDetails[0]->fullName}}'s Profile</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <img src="/storage/{{$userDetails[0]->photo}}"
                             style="width:200px; height:200px; float:left; margin-right:25px;">
                        <h5> {{$userDetails[0]->email}}</h5>
                        <h6>User Type</h6>
                        {{$userDetails[0]->type}}
                    </div>
                    <div class="col-md-5">
                        <form method="POST" action="{{ route('user.update') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="First Name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('First_name') }}</label>

                                <div class="col-md-6">
                                    <input id="First Name" type="text"
                                           class="form-control{{ $errors->has('First_name') ? ' is-invalid' : '' }}"
                                           name="first_name" placeholder="{{$userDetails[0]->first_name}}"
                                           value="{{$userDetails[0]->first_name}}" autofocus>

                                    @if ($errors->has('First_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('First_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Last Name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Last_name') }}</label>

                                <div class="col-md-6">
                                    <input id="Last Name" type="text"
                                           class="form-control{{ $errors->has('Last_name') ? ' is-invalid' : '' }}"
                                           name="last_name" placeholder="{{$userDetails[0]->last_name}}"
                                           value="{{$userDetails[0]->last_name}}" autofocus>

                                    @if ($errors->has('Last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" value="{{$userDetails[0]->id}}" name="user_id">
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i>
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2">
                        <a href="/profile/{{$userDetails[0]->id}}/delete"
                           onclick="return confirm('Are you sure u want to delete this User?')"
                           class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete User</a>
                    </div>

                </div>
            </div>
            <hr>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <h5>Photos <i class="fas fa-image"></i></h5>
                        <div class="table-wrapper-scroll-y">
                            <div class="row">
                                @foreach($userDetails[0]->photos as $photo)
                                    <div class="column">
                                        <a href="/admin/photos/{{$photo->id}}"><img src='/storage/{{$photo->photo}}' class='image'></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <h5><i class="fas fa-comments"></i> User Conversations</h5>
                        <div id="conversation-list">
                            {{! $count = 1}}
                        @foreach($userDetails[0]->conversations as $conversation)
                                <div class="alert alert-primary" role="alert">
                                    <h5>{{$count}}</h5> <a id="style-a" href="/admin/conversations/{{$conversation->id}}">{{$conversation->custom_name}}</a>
                                </div>
                            {{! $count++}}
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
