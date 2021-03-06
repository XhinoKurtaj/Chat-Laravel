@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @php
                    $conversation = App\Conversation::findOrFail(request()->route('id'))
                @endphp
                <img src="/storage/{{$conversation->custom_photo }}"
                     style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                <form enctype="multipart/form-data" action="{{route('show.conversation',request()->route('id'))}}"
                      method="POST">
                    @csrf
                    <label>Conversation Image</label>
                    <input type="file" name="custom_photo">
                    @if($conversation->type == 'group')
                        <input type="text" name="custom_name" placeholder="Conversation name"
                               value="{{$conversation->custom_name}}">
                    @else
                        <input type="hidden" name="custom_name" placeholder="Conversation name"
                               value="{{$conversation->custom_name}}">
                    @endif
                    <input type="submit" class="pull-right btn btn-sm btn-primary">
                </form>
                <input type="hidden" id="conversation-id" value="{{$conversation->id}}">
                <br><br><br><br>
                @if($conversation->type == "group")
                    <a href="{{ route('leave.conversation',request()->route('id')) }}"
                       class="btn btn-small btn-outline-danger"
                       onclick="return confirm('Are you sure you want to leave this conversation?')">
                        <i class="fas fa-sign-out-alt"></i> Leave Conversation</a>
                @endif
            </div>
        </div>
        <br>
        <hr>
        <a href="{{ route("conversation.list") }}" class="btn btn-outline-secondary"><i
                    class="fas fa-arrow-circle-left"></i> Back</a>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-9">
                <h5>Attachments <i class="fas fa-paperclip"></i></h5>
                <div class="table-wrapper-scroll-y">
                    <div class="row" id="attachment-list">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <h5>Members <i class="fas fa-users"></i></h5>
                <div class="table-wrapper-scroll-y">
                    <table class="table table-striped ">
                        <tbody id="showMemberList">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
