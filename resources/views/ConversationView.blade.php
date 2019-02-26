@extends('adminlte::page')
@section('content-conversation-details')
    <style>
        #conversation-image {
            width: 150px;
            height: 150px;
            float: left;
            margin-right: 25px;
        }

        #message-list {
            overflow: auto;
            height: 300px;
            width: 600px;
            background: whitesmoke;
        }

        .position {
            position: absolute;
            bottom: 0;
            left: 5px;
        }

        .img-thumbnail {
            height: 200px;
            width: 200px;
            word-wrap: break-word;
        }

        .ahref-style {
            font-size: 15px;
            width: 200px;
            height: 200px;
            border: 1px solid red;
            white-space: pre-wrap; /* css-3 */
            white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
            white-space: -pre-wrap; /* Opera 4-6 */
            white-space: -o-pre-wrap; /* Opera 7 */
            word-wrap: break-word; /* Internet Explorer 5.5+ */

        }

        .table-wrapper-scroll-y {
            display: block;
            max-height: 370px;
            overflow-y: auto;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

        a.style-link {
            color: black;
            text-decoration: none;
        }

        a.style-link:hover {
            color: blue;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-3">
                        <img src="/storage/{{$conversationDetails[0]->custom_photo }}" id="conversation-image">
                        <h4>{{$conversationDetails[0]->custom_name }}</h4>
                        <a onclick="return confirm('Are you sure u want to delete this conversation?')"
                           href="{{ route('conversation.delete', $conversationDetails[0]->id) }}"
                           class="btn btn-outline-danger btn-sm position">
                            <i class="far fa-trash-alt"> Delete Conversation</i></a>
                    </div>
                    <div class="col-4">
                        <h5><i class="far fa-edit"></i> Update Conversation</h5>
                        <hr>
                        <form enctype="multipart/form-data"
                              action="{{route('show.conversation',request()->route('id'))}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="FormControlFile1">Conversation photo</label>
                                <input type="file" name="custom_photo" class="form-control-file" id="FormControlFile1">
                            </div>
                            @if($conversationDetails[0]->type == 'group')
                                <div class="form-group">
                                    <label for="InputName">Conversation Name</label>
                                    <input type="text" name="custom_name" class="form-control" id="InputName"
                                           placeholder="Enter Conversation Name"
                                           value="{{$conversationDetails[0]->custom_name}}">
                                </div>
                            @else
                                <input type="hidden" name="custom_name" placeholder="Conversation name"
                                       value="{{$conversationDetails[0]->custom_name}}">
                            @endif
                            <div class="form-group">
                                <input type="submit" class="pull-right btn btn-sm btn-primary">
                            </div>
                        </form>
                    </div>
                    <div class="col-5">
                        <h5><i class="fas fa-comments"></i> Conversation Messages</h5>
                        <div id="message-list">
                            @foreach($conversationDetails[0]->message as $message)
                                <div class="alert alert-primary" role="alert">
                                    <a class="style-link"
                                       href='/admin/users/{{$message->sender->id}}'> {{$message->sender->fullName}}</a>
                                    :
                                    <a href='/admin/messages/{{$message->id}}'
                                       class="style-link"> {{$message->message}}</a>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <div class="row">
            <div class="col-9">
                <h5>Attachments <i class="fas fa-paperclip"></i></h5>
                <div class="table-wrapper-scroll-y">
                    <div class="row" id="attachment-list">
                        @foreach($conversationDetails[0]->attachment as $attachment)
                            {{! $mime = $attachment->attachment}}
                            @if(strpos($mime, '.jpg')|| strpos($mime, '.jpeg') ||strpos($mime, '.png') ||strpos($mime, '.gif'))
                                <div class='column'>
                                    <a href="/home/conversation/{{$conversationDetails[0]->id}}/download/{{$attachment->id}}">
                                        <img src='/storage/{{$attachment->attachment}}' class='img-thumbnail'>
                                    </a>
                                </div>
                            @else
                                <div class='column ahref-style'>
                                    <a style='text-decoration:none'
                                       href='/home/conversation/{{$conversationDetails[0]->id}}/download/{{$attachment->id}}'>
                                        {{$attachment->attachment}}<br><br><i class='fas fa-download'
                                                                              style='color:gray'></i>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-3">
                <h5>Members <i class="fas fa-users"></i></h5>
                <div class="table-wrapper-scroll-y">
                    <table class="table table-striped ">
                        <tbody id="showMemberList">
                        @foreach($conversationDetails[0]->users as $users)
                            <tr class='table-active'>
                                <td><strong>
                                        <a href='/admin/users/{{$users->id}}'> {{$users->fullName}}</a>
                                    </strong>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
