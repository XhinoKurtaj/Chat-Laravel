@include('/partial/header')
<style>
.test{
    border:1px dotted;
}
</style>
<div class="container">
<div class="row">
    <div class="col-4"></div>
    <div class="col-8">
        <div class="container test">

            <div class="col-12 col-sm-6 col-md-8">
                <div class="card">
                    <div class="card-body" style="overflow: auto" id="textResponse">
                        <div>
                            <p id="msgField"></p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('message.store',request()->route('id')) }}" method="POST">
                            @csrf
                        <div class="input-group">
                            <textarea class="form-control" aria-label="With textarea" id="msgArea" name="message"> </textarea>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><input type="submit" href=""  id="btn_send" class="btn-lg btn-success" value="Send"></span>
                            </div>
                        </div>
                        <div class="container">
                            <label for="profile_pic">Choose file to upload</label>
                            <input type="file" class="btn btn-sm " id="attach" name="attach">
                        </div>
                        </form>
                    </div>
                    <input type="hidden" value="{{request()->route('id')}}" id="convId">
                    <button onclick="getMsg()">test</button>
                </div>
            </div>


        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
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
                    console.log(result[i].message);
                    // output += "<h6><strong>"+result[i].message</strong></h6>";
                    output += "<p>"+result[i].message+"</p> <br>";
                }
                display.html(output);
            }
        })
    }
</script
@include('/partial/footer')