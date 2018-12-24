@include('../partial/header')
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

    </style>
</head>
<body>
<div class="row">
    @if(empty($photoList))
        <div class='container'>
            <div class='row'>
                <div class='col-3'></div>
                <div class='col-6' style= 'margin-top: 100px'>
                    <h5> You dont have any photo</h5>
                    </div>
                <div class='col-3'></div>
            </div>
        </div>
    @else
        @foreach($photoList as $photo)
            <div class='col-4 col-md-2 frame'>
                <img src="{{ $photo->photo}}" id='photo_pic' alt='Card image cap'>
                <p><small class='text-muted'>{{$photo->created_at}}</small></p>
                <form action='' method='GET'>
                    @csrf
                    <input type='text' value='{{$photo->added_date}}' name='photoName' style='visibility:hidden'>
                    <input type='submit' class='btn btn-sm btn-outline-info' name='profilePhoto' value='Set as photo profile'>&nbsp&nbsp
                    <a href="{{ route('photo.delete',$photo->id) }}" class='btn btn-sm btn-outline-danger '  name='deletePhoto'>Delete</a>
                </form>
            </div>
        @endforeach
    @endif
@include('../partial/footer')
