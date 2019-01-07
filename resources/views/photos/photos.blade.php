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

        .photo {
            width:200px;
            height:200px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        @if (Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! Session::get('success') !!}</li>
            </ul>
        </div>
        @endif
    </div>
<div class="row">

    @foreach($photoList as $photo)
            <div class='col-4 col-md-2 frame'>
                <img src="/storage/{{ $photo->photo }}" class='photo' alt='Card image cap'>
                <p><small class='text-muted'>{{$photo->created_at}}</small></p>
                <form action='' method='GET'>
                    @csrf
                    <input type='text' value='{{$photo->added_date}}' name='photoName' style='visibility:hidden'>
                    <a href="{{ route('profile.photo',$photo->id) }}" type='submit' class='btn btn-sm btn-outline-info' name='profilePhoto'>Set as photo profile</a>&nbsp&nbsp
                    <a href="{{ route('photo.delete',$photo->id) }}" class='btn btn-sm btn-outline-danger '  name='deletePhoto'>Delete</a>
                </form>
            </div>
        @endforeach
</div>
</div>

@include('../partial/footer')
