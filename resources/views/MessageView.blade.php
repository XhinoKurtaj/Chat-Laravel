@extends('layouts.app')
<style>
    td a{
        color: black;
        text-decoration: none;
    }:hover{font-family:"Arial"}
</style>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        @if($messageDetails[0]->attachment != null)
                        <th colspan="8">Details</th>
                            @else
                            <th colspan="6">Details</th>
                            @endif
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th colspan="2">Message</th>
                        <th colspan="2">Sender</th>
                        <th colspan="2">Conversation</th>
                        @if($messageDetails[0]->attachment != null)
                        <th colspan="2">Attachment</th>
                            @endif
                    </tr>
                    <tr>
                        <th scope="row">Message Id</th>
                        <td>{{$messageDetails[0]->id}}</td>
                        <th scope="row">Sender Id</th>
                        <td>{{$messageDetails[0]->sender->id}}</td>
                        <th scope="row">Conversation Id</th>
                        <td>{{$messageDetails[0]->conversation->id}}</td>
                        @if($messageDetails[0]->attachment != null)
                        <th scope="row">Attachment Id</th>
                        <td>{{$messageDetails[0]->attachment->id}}</td>
                            @endif
                    </tr>
                    <tr>
                        <th scope="row">Message</th>
                        <td >{{$messageDetails[0]->message}}</td>
                        <th scope="row">Sender Name</th>
                        <td>
                            <a href="/users/{{$messageDetails[0]->sender->id}}">
                                {{$messageDetails[0]->sender->fullName}}</a>
                        </td>
                        <th scope="row">Conversation Name</th>
                        <td>
                            <a href="/home/conversation/{{$messageDetails[0]->conversation->id}}/edit">
                                {{$messageDetails[0]->conversation->custom_name}}</a>
                        </td>
                        @if($messageDetails[0]->attachment != null)
                            <th scope="row">Attachment</th>
                            <td style="word-break: break-all;">
                                <a href="/attachment/{{$messageDetails[0]->attachment->id}}">
                                    {{$messageDetails[0]->attachment->attachment}}</a>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th scope="row">Message Sended Time</th>
                        <td>{{$messageDetails[0]->created_at}}</td>
                        <th scope="row">Sender Email</th>
                        <td>
                            <a href="/users/{{$messageDetails[0]->sender->id}}">
                                {{$messageDetails[0]->sender->email}}</a>
                        </td>
                        <th scope="row">Conversation Created Time</th>
                        <td>{{$messageDetails[0]->conversation->created_at}}</td>
                        @if($messageDetails[0]->attachment != null)
                            <th></th>
                            <td></td>
                            @endif

                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <th scope="row">Sender Type</th>
                        <td>{{$messageDetails[0]->sender->type}}</td>
                        <th scope="row">Conversation Type</th>
                        <td>{{$messageDetails[0]->conversation->type}}</td>
                        @if($messageDetails[0]->attachment != null)
                            <th></th>
                            <td></td>
                        @endif

                    </tr>
                    </tbody>
                </table><hr>
                <a href="{{route('messages.table')}}" class="btn btn-outline-secondary"><i class="fas fa-arrow-circle-left"></i> Back</a>
                <a onclick="return confirm('Are you sure u want to delete this Message?')" href="{{$messageDetails[0]->id}}/delete"  class="btn btn-outline-danger " >
                    <i class="far fa-trash-alt"> Delete Message</i></a>
            </div>
    </div>

@endsection