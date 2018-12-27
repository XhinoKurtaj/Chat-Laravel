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
</style>
<div class="container-fluid">
    <div class="row no-gutters" >
        <div class="col-6 col-md-4">
            <div class="container">
                <div class="card mb-3" style="max-width: 18rem;">
                    <div class="container center">
                        <img src="<?php ?>" alt="Avatar" id="photo_pic">
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
                            <a href="UpdateData.php" class="dropdown-item onMouse">Update User Data</a>
                            <a href="PhotoBoard.php" class="dropdown-item onMouse">Choose a photo</a>
                            <a href="ConversationLists.php" class="dropdown-item onMouse">Leave Conversation</a>
                            <hr>
                            <a href="" class="dropdown-item btn" id="deleteUser">Delete User</a>
                        </div>
                    </div>
                </div>
                    <input type="text" name="addMemberFirstName" id="addMemberFirstName" placeholder="First Name">
                    <input type="text" name="addMemberLastName" id="addMemberLastName" placeholder="Last Name">
                <button class="btn btn-outline-success" name="addButton" id="addButton">Add</button><br><br><br>
                <button onclick="getMembers()">testMembers</button>
                    <table class="table table-striped">
                        <thead>
                            <tr class="table-success">
                                <th scope="col">#</th>
                                <th scope="col" class="">Conversation Members</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr class="table-active" id="showMemberList">
                                </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    <div class="col-12 col-sm-6 col-md-8">
        <div class="card">
            <div class="card-body" style="overflow: auto" id="textResponse">
                <div> <p id="msgField"></p> </div>
            </div>
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('message.store',request()->route('id')) }}" method="POST" nctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <textarea class="form-control" aria-label="With textarea" id="msgArea" name="message"> </textarea>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><input type="submit" href=""  id="btn_send" class="btn-lg btn-success" value="Send"></span>
                            </div>
                        </div>
                        <div class="container">
                            <label for="profile_pic">Choose file to upload</label>
                            <input type="file" class="btn btn-sm " id="attach" name="attachment">
                        </div>
                        </form>
                        {{--============================================================================================--}}
                        <input type="hidden" value="{{request()->route('id')}}" id="convId">
                        {{--============================================================================================--}}
                        <button onclick="getMsg()">test</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
    <script>
    function getMsg() {
        var id=$("#convId").val();
        var display = $("#msgField");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: id +'/read',
            success:function(result){
                var output = "";
                for(var i in result){
                    output += "<h6><strong>"+result[i].sender.fullName+"</strong></h6>"+
                    "<p>"+result[i].message+"</p> <br>";
                }
                display.html(output);
            }
        })
    }

    function getMembers()
    {
        var id=$("#convId").val();
        var display = $("#showMemberList");
        var counter = 1;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: id +'/members',
            success:function(data){
                var output = "";
                for(var i in data){
                    output += "<td ><strong>"+ counter++ +"</strong></td>"+
                        "<td>"+data[0].fullName +"</td>";
                }
                display.html(output);
            }
        })
    }

</script>
@include('/partial/footer')