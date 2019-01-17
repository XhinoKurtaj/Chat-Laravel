@extends('layouts.app')
<style>
    body{
        background-color:lightgray;
    }
</style>
@section('content')

    <div class="container-fluid">
        <div class="row">
        <div class="col-7 align-self-start">
            <img src="/storage/{{ Auth::user()->photo }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                <h2>{{ Auth::user()->fullName }}'s Profile</h2>
            <a href="{{route('photo.show')}}">Your photos</a>

            <br><br><hr>
            <a href="{{ route('conversation.list') }}" class="btn btn-outline-secondary">Back</a>
            <br><hr><hr><br>
            <button id="DeleteUser" class="btn btn-outline-danger">Delete User</button>
        </div>
        <div class="col-5 align-self-end">
            <div class="card">
                <div class="card-header">Change your data</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="First Name" class="col-md-4 col-form-label text-md-right">{{ __('First_name') }}</label>

                                <div class="col-md-6">
                                    <input id="First Name" type="text" class="form-control{{ $errors->has('First_name') ? ' is-invalid' : '' }}" name="first_name" placeholder="{{Auth::user()->first_name}}"  autofocus>

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
                                    <input id="Last Name" type="text" class="form-control{{ $errors->has('Last_name') ? ' is-invalid' : '' }}" name="last_name" placeholder="{{Auth::user()->last_name}}" autofocus>

                                    @if ($errors->has('Last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! Session::get('success') !!}</li>
                </ul>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>





    {{--<div class="container-fluid">--}}
        {{--<div class="row">--}}
            {{--@if (Session::has('success'))--}}
                {{--<div class="alert alert-success">--}}
                    {{--<ul>--}}
                        {{--<li>{!! Session::get('success') !!}</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--@endif--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--@foreach($photoList as $photo)--}}
                {{--<div class='col-4 col-md-2 frame'>--}}
                    {{--<img src="/storage/{{ $photo->photo }}" class='photo' alt='Card image cap'>--}}
                    {{--<p><small class='text-muted'>{{$photo->created_at}}</small></p>--}}
                    {{--<form action='' method='GET'>--}}
                        {{--@csrf--}}
                        {{--<input type='text' value='{{$photo->added_date}}' name='photoName' style='visibility:hidden'>--}}
                        {{--<a href="{{ route('profile.photo',$photo->id) }}" type='submit' class='btn btn-sm btn-outline-info' name='profilePhoto'>Set as photo profile</a>&nbsp&nbsp--}}
                        {{--<a href="{{ route('photo.delete',$photo->id) }}" class='btn btn-sm btn-outline-danger '  name='deletePhoto'>Delete</a>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}




    <script src="/js/app.js"></script>

@endsection