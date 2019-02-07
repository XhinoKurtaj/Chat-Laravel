@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @php
                 $conversation = App\Conversation::findOrFail(request()->route('id'))
                 @endphp
                <img src="/storage/{{$conversation->custom_photo }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                <form enctype="multipart/form-data" action="{{route('show.conversation',request()->route('id'))}}" method="POST">
                    @csrf
                    <label>Conversation Image</label>
                    <input type="file" name="custom_photo">
                    @if($conversation->type == 'group')
                        <input type="text" name="custom_name" placeholder="Conversation name" value="{{$conversation->custom_name}}">
                    @else
                        <input type="hidden" name="custom_name" placeholder="Conversation name" value="{{$conversation->custom_name}}">
                    @endif
                    <input type="submit" class="pull-right btn btn-sm btn-primary">
                </form>
            </div>
        </div>
        <br><hr>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
    </div>
@endsection
