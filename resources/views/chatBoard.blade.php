@include('/partial/header')
<style>
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
    #deleteUser:hover{
        background-color:red;
        color: white;
    }
    .onMouse:hover{
        background-color:lightgray;
    }
    #photo_pic{
        width:90%;
        margin-top: 10px;
        padding: 5px 0px 0px 5px;
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
    /*#4dc0b5*/
</style>
<div id="app" class="container-fluid">
    <div class="container-fluid">
        <div class="row" style="background-color:lightgray">
            <div class="col-10"></div>
            @php
                 $conversation = App\Conversation::findOrFail(request()->route('id'))
            @endphp
        <img src="/storage/{{ $conversation->custom_photo }}" style="width:42px; height:42px; border-radius: 50%; top:10px; left:10px;">
        &nbsp{{$conversation->custom_name }}
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="card mb-3" style="max-width: 18rem;">
                <div class="container center">
                    <img src="/storage/{{ Auth::user()->photo }}" alt="Avatar" id="photo_pic" style="width:200px;height:200px;">
                    <h5 id="username"></h5>
                </div>
                <div class="btn-group dropright ">
                    <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="btnSettings">
                        {{ Auth::user()->fullName}}
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <a href="{{route ('user.profile')}}" class="dropdown-item onMouse">User Profile</a>
                        <a href="{{ route('photo.show') }}" class="dropdown-item onMouse">Choose a photo</a>
                        <a href="" class="dropdown-item onMouse">Leave Conversation</a>
                        <a href="{{ route('conversation.list') }}" class="dropdown-item onMouse">Conversation List</a>
                        <hr>
                        <a href="" class="dropdown-item btn" id="deleteUser">Delete User</a>
                    </div>
                </div>
            </div>
            <form method="GET" action="{{ route('add.members',request()->route('id')) }}">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" id="searchText" placeholder="Search">
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-info" >Search</button>
                    </div>
                </div>
            </form>
            @if (\Session::has('error'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('error') !!}</li>
                    </ul>
                </div>
            @elseif (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            <br><br>
            <button onclick="getMembers()">testMembers</button>
            <table class="table table-striped">
                <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col" class="">Conversation Members</th>
                </tr>
                </thead>
                <tbody id="showMemberList">
                </tbody>
            </table>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body" style="overflow: auto" id="textResponse">
                    <div> <p id="msgField">
                        </p> </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-9">
                                <p id="messageField">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="input-group">
                            <textarea class="form-control" aria-label="With textarea" id="msgArea" name="message"> </textarea>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><input type="submit"   id="btn_send" class="btn-lg btn-success" value="Send"></span>
                            </div>
                        </div>
                        <div class="container">
                            <label for="profile_pic">Choose file to upload</label>
                            <input type="file" class="btn btn-sm " id="attach" name="attachment">
                        </div>
                        <input type="hidden" value="{{request()->route('id')}}" id="convId">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-1">col-4</div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="/js/app.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>

@include('/partial/footer')