@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="6">Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th colspan="2">Message</th>
                        <th colspan="2">Sender</th>
                        <th colspan="2">Conversation</th>
                    </tr>
                    <tr>
                        <th scope="row">Message Id</th>
                        <td>{{$messageDetails[0]->id}}</td>
                        <th scope="row">Sender Id</th>
                        <td>{{$messageDetails[0]->sender->id}}</td>
                        <th scope="row">Conversation Id</th>
                        <td>{{$messageDetails[0]->conversation->id}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Message</th>
                        <td >{{$messageDetails[0]->message}}</td>
                        <th scope="row">Sender Name</th>
                        <td>{{$messageDetails[0]->sender->fullName}}</td>
                        <th scope="row">Conversation Name</th>
                        <td>{{$messageDetails[0]->conversation->custom_name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Message Sended Time</th>
                        <td>{{$messageDetails[0]->created_at}}</td>
                        <th scope="row">Sender Email</th>
                        <td>{{$messageDetails[0]->sender->email}}</td>
                        <th scope="row">Conversation Created Time</th>
                        <td>{{$messageDetails[0]->conversation->created_at}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <th scope="row">Sender Type</th>
                        <td>{{$messageDetails[0]->sender->type}}</td>
                        <th scope="row">Conversation Type</th>
                        <td>{{$messageDetails[0]->conversation->type}}</td>
                    </tr>
                    </tbody>
                </table><hr>
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-circle-left"></i> Back</a>
                <a onclick="return confirm('Are you sure u want to delete this Message?')" href="{{$messageDetails[0]->id}}/delete"  class="btn btn-outline-danger " >
                    <i class="far fa-trash-alt"> Delete Message</i></a>
            </div>
    </div>

@endsection