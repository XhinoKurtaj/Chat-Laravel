@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @php
                 $conversation = App\Conversation::findOrFail(request()->route('id'))
                 @endphp
                <img src="/storage/{{$conversation->custom_photo }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                <h2></h2>
                <form enctype="multipart/form-data" action="{{route('show.conversation',request()->route('id'))}}" method="POST">
                    @csrf
                    <label>Conversation Image</label>
                    <input type="file" name="custom_photo">
                    <input type="text" name="custom_name" placeholder="Conversation name" value="{{$conversation->custom_name}}">
                    <input type="submit" class="pull-right btn btn-sm btn-primary">
                </form>
            </div>
        </div><br><hr>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
    </div>
@endsection
