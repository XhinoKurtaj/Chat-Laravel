@extends('layouts.app')
<style>
    body {
        background-color: lightgray;
    }
</style>
@section('content')

    <div class="container" style="background: whitesmoke"><br>
        <div class="row">
            <div class="col-6 align-self-start">
                <div class="row">
                    <div class="col-9">
                        <h2>{{ Auth::user()->fullName }}'s Profile</h2>
                        <img src="/storage/{{ Auth::user()->photo }}"
                             style="width:300px; height:200px; margin-right:25px;" class="img-fluid img-thumbnail">
                        <br><hr>
                        <a href="{{ route('conversation.list') }}" class="btn btn-outline-secondary"><i
                                    class="fas fa-arrow-circle-left"></i> Back</a>
                    </div>
                    <div class="col-3">
                        <br>
                        <br>
                        <a href="{{route('photo.show')}}" class="btn btn-outline-info">
                            <i class="fas fa-images"></i> Your photos</a>
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

            <div class="col-6">
                <div class="card">
                    <div class="card-header">Change your data</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="First Name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('First_name') }}</label>

                                <div class="col-md-6">
                                    <input id="First Name" type="text"
                                           class="form-control{{ $errors->has('First_name') ? ' is-invalid' : '' }}"
                                           name="first_name" placeholder="{{Auth::user()->first_name}}"
                                           value="{{Auth::user()->first_name}}" autofocus>

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
                                           name="last_name" placeholder="{{Auth::user()->last_name}}"
                                           value="{{Auth::user()->last_name}}" autofocus>

                                    @if ($errors->has('Last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

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
                <br>
                <a href="/profile/{{auth()->user()->id}}/delete"
                   onclick="return confirm('Are you sure u want to delete this User?')"
                   class="btn btn-outline-danger"><i class="far fa-trash-alt"></i> Delete User</a>
            </div>
        </div>
    </div>

    <script src="/js/app.js"></script>

@endsection

