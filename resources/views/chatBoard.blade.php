@include('/partial/header')
<style xmlns="http://www.w3.org/1999/html">
    .container-fluid{
        width:100%;
        height:100%;
        margin-top:20px;
    }
    .card-body{
        border-style:outset;
        border-width:5px;
        font-family: "Times New Roman", Times, serif;
    }
    #textResponse{
        height:700px;
    }
    .onMouse:hover{
        background-color:lightgray;
    }
    #photo_pic{
        width:90%;
        margin-top: 10px;
        padding: 5px 0 0 5px;
    }
    #username{
        text-align: center;
        font-family: "Times New Roman", Times, serif;
        color:orange;
    }
    #btnSettings{
        margin-bottom: 10px;
    }
    .center{
        text-align: center;
    }
    .span-position{
        position: absolute;
        top: 0;
        left: 25px;
        font-size: 20px;
        color: red;
    }
    .alert-heading{
        margin:auto;
        font-family: "Times New Roman", Times, serif;
        font-size: 18px;
    }
    .mb-0{
        padding-left: 5em;
    }
    .sender{
        text-align: right;
    }
    .user-icon{
        width:32px;
        height:32px;
        top:10px;
        left:10px;
        border-radius:50%;
    }
    .col-2 {
        -moz-hyphens:auto;
        -ms-hyphens:auto;
        -webkit-hyphens:auto;
        hyphens:auto;
        word-wrap:break-word;
    }
    .img-thumbnail{
        height: 100px;
        width: 100px;
    }

    .delete-message{
        position: absolute;
        right: 3px;
        bottom: 3px;
    }
    .search-bar{
        margin:10px;
    }
    #button-addon2{
        margin-top:10px;
    }
    #nameDropDown{
        margin: 0 10px 10px 10px;
    }
    #conversation-name{
        font-size:20px;
        font-family: "Times New Roman", Times, serif;
        color: black;
        margin-left: 10px;
        text-align: right;
    }
    #conversation-name:hover{
        color: blueviolet;
        font-family: "Nunito", sans-serif;
    }

    .table-wrapper-scroll-y {
        display: block;
        max-height: 500px;
        overflow-y: auto;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }
    .attachment-wrapper-scroll-y {
        display: block;
        max-height: 850px;
        overflow-y: auto;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }
    ::-webkit-scrollbar {
        width: 0px;
    }

</style>
<div id="app" class="container-fluid">
    <div class="container-fluid">
        <div class="row " style="background-color:lightgray">
            <div class="col-5">
            </div>
            @php
                 $conversation = App\Conversation::findOrFail(request()->route('id'))
            @endphp
        <img src="/storage/{{ $conversation->custom_photo }}" style="width:42px; height:42px; border-radius: 50%; top:10px; left:10px;">
            &nbsp<a  id='conversation-name' href="{{route('show.conversation', $conversation->id)}}"><em><strong>{{$conversation->custom_name }}<strong></strong></em></a>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="card mb-3" style="max-width: 18rem;">
                <div class="container center">
                    <img src="/storage/{{ Auth::user()->photo }}" alt="Avatar" id="photo_pic" class="img-thumbnail" style="width:200px;height:200px;">
                    <h5 id="username"></h5>
                </div>
                <div class="btn-group dropdown ">
                    <button type="button" class="btn btn-sm btn-info dropdown-toggle btn-block" id="nameDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="btnSettings">
                        {{ Auth::user()->fullName}}
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{route ('user.profile')}}" class="dropdown-item onMouse"><i class="fas fa-user-alt"></i> User Profile</a>
                        <a href="{{ route('photo.show') }}" class="dropdown-item onMouse"><i class="fas fa-images"></i> Choose a photo</a>
                        <a href="{{ route('conversation.list') }}" class="dropdown-item onMouse"><i class="fas fa-list-alt"></i> Conversation List</a>
                        {{--<hr>--}}
                        {{--<a href="{{ route('leave.conversation',request()->route('id')) }}" class="dropdown-item onMouse" onclick="return confirm('Are you sure you want to leave this conversation?')"><i class="fas fa-sign-out-alt"></i> Leave Conversation</a>--}}
                    </div>
                </div>
            </div>
            @if($conversation->type == 'group')
                <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="member" class="form-control" id="search-text" placeholder="Search">
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-info" id="add-member">Add Memeber</button>
                        </div>
                </div>
                <br><br>
                    @endif
            <div id="alerts">

            </div>
            <div class="table-wrapper-scroll-y">
                <table class="table table-striped ">
                    <thead>
                    <tr class="table-success">
                        <th scope="col"><i class="fas fa-users"></i></th>
                        <th scope="col" class="">Conversation Members</th>
                    </tr>
                    </thead>
                    <tbody id="showMemberList">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-7">
            <div class="card">
                <div class="card-body" style="overflow:auto" id="textResponse">
                     <p id="message-display"></p>
                    <span class="span-position" id="User-notification"> </span>
                </div>
                </div>
                <div class="card-body" style="padding: 5px 0 5px 0 ;">
                    <div class="container ">
                        <form id="form" action="{{ route('message.store',request()->route('id')) }}" method="POST" id="ajax" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group ">
                                <textarea class="form-control shadow p-3 mb-5 bg-white rounded " aria-label="With textarea" id="msgArea" name="message" required style="resize: none;" maxlength="255"> </textarea>
                                <div class="input-group-prepend">
                                    <span class="input-group-text shadow p-3 mb-5 bg-white rounded"><input type="submit"   id="btn_send" class="btn-lg btn-success" value="Send"></span>
                                </div>
                            </div>
                                <label for="profile_pic">Choose file to upload <i class="fas fa-upload"></i></label>
                                <input type="file"  class="btn btn-sm" id="attachment" name="attachment">
                        </form>
                        <input type="hidden" value="{{request()->route('id')}}" id="convId">
                    </div>
                </div>
            </div>
        <div class="col-2">
            <div class="attachment-wrapper-scroll-y">
                <h6>Attachments <i class="fas fa-paperclip"></i></h6>
                <hr>
                <ul id="attachment-list">
                </ul>
            </div>
        </div>
    </div>
</div>
    {{--<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>--}}
    <script src="/js/app.js"></script>
    {{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>--}}
<script>
    $('#attachment').on('change',function(){
        var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
@include('/partial/footer')