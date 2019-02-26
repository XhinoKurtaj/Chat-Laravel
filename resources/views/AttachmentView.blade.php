@extends('adminlte::page')
<style>
    #img{
        width:200px;
        height:250px;
        float:left;
        margin-right:25px;
        border: 1px solid black;
    }
   td a{
        color: black;
        text-decoration: none;
    }:hover{color:blue}
</style>
@section('content-attachment-details')
    <div class="container-container" style="background: white">
        <br>
        {{!$mime = $attachmentDetails[0]->attachment}}
        @if(strpos($mime, '.jpg')|| strpos($mime, '.jpeg') ||strpos($mime, '.png') ||strpos($mime, '.gif'))
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-3">
                        <a href="/home/conversation/{{$attachmentDetails[0]->conversation->id}}/download/{{$attachmentDetails[0]->id}}"><img
                                    src="/storage/{{$mime}}" id="img" class=" shadow p-3 mb-5 bg-white rounded"></a>
                    </div>
                    <div class="col-md-9">
                        @else
                            <div class="container">
                                <div class="row">
                                    @endif
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th colspan="8">Attachment Details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th colspan="2">Attachment</th>
                                            <th colspan="2">Message</th>
                                            <th colspan="2">Conversation</th>
                                            <th colspan="2">Sender</th>
                                        </tr>
                                        <tr>
                                            <th scope="row">Attachment Id</th>
                                            <td>{{$attachmentDetails[0]->id}}</td>
                                            <th scope="row">Message Id</th>
                                            <td>{{$attachmentDetails[0]->message->id}}</td>
                                            <th scope="row">Conversation Id</th>
                                            <td>{{$attachmentDetails[0]->conversation->id}}</td>
                                            <th scope="row">Sender Id</th>
                                            <td>{{$attachmentDetails[0]->message->sender->id}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Attachment</th>
                                            <td style="word-break: break-all;">
                                                <a href="/home/conversation/{{$attachmentDetails[0]->conversation->id}}/download/{{$attachmentDetails[0]->id}}">
                                                    {{$attachmentDetails[0]->attachment}}</a></td>
                                            <th scope="row">Message</th>
                                            <td>
                                                <a href="/admin/messages/{{$attachmentDetails[0]->message->id}}">
                                                    {{$attachmentDetails[0]->message->message}}</a>
                                            </td>
                                            <th scope="row">Conversation Name</th>
                                            <td>
                                                <a href="/admin/conversations/{{$attachmentDetails[0]->conversation->id}}">
                                                    {{$attachmentDetails[0]->conversation->custom_name}}</a>
                                            </td>
                                            <th scope="row">Sender Name</th>
                                            <td>
                                                <a href="/admin/users/{{$attachmentDetails[0]->message->sender->id}}">
                                                    {{$attachmentDetails[0]->message->sender->fullName}}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Attachment Sended Time</th>
                                            <td>{{$attachmentDetails[0]->message->created_at}}</td>
                                            <th scope="row">Message Sended Time</th>
                                            <td>{{$attachmentDetails[0]->message->created_at}}</td>
                                            <th scope="row">Conversation Type</th>
                                            <td>{{$attachmentDetails[0]->conversation->type}}</td>
                                            <th scope="row">Sender Email</th>
                                            <td>
                                                <a href="/admin/users/{{$attachmentDetails[0]->message->sender->id}}">
                                                    {{$attachmentDetails[0]->message->sender->email}}</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <br>
                            <hr>
                            <a href="{{ route('attachments.table') }}" class="btn btn-outline-secondary"><i
                                        class="fas fa-arrow-circle-left"></i> Back</a>
                    </div>
                </div>
@endsection
