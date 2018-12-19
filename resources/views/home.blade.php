@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Conversation List</div>
                <div class="card-body">
                    <ul>
                        <li>test</li>
                        <li>test</li>
                    </ul>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header"><img src="" alt="Avatar" id="photo_pic"></div>
                <div class="card-body">
                    <h6>{{Auth::user()->name}}  {{Auth::user()->surname}}</h6>
                </div>
            </div>
        </div>
</div>
@endsection
