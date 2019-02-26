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
        /*.wrapp{*/
            /*padding: 10px 5px 20px 5px;*/
        /*}*/
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="container-fluid wrapp">
            <div class="row">
                <div class="col-4">
                    <form method="post" action="{{ route('photo.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="photo">
                        <input type="submit" class="btn btn-outline-dark " value="Upload">
                    </form>
                </div>
                <div class="col-4">
                    <a href="{{route('user.profile')}}" class="btn btn-outline-info"><i
                                class="fas fa-arrow-circle-left"></i> Back to profile</a>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        @if (Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
    </div>
    <div class="container-fluid">
    <div class="row" style="background: whitesmoke">
        @foreach($photoList as $photo)
            <div class='col-3 '>
                <div class="container" style="padding-top: 10px">
                    <img src="/storage/{{ $photo->photo }}" class='photo' alt='Card image cap'>
                    <p>
                        <small class='text-muted'>{{$photo->created_at}}</small>
                    </p>
                    <form action='' method='GET'>
                        @csrf
                        <input type='text' value='{{$photo->added_date}}' name='photoName' style='visibility:hidden'>
                        <a href="{{ route('profile.photo',$photo->id) }}" type='submit'
                           class='btn btn-sm btn-outline-info'
                           name='profilePhoto'><i class="far fa-image"></i> Set Profile Photo</a>&nbsp
                        <a href="{{ route('photo.delete',$photo->id) }}" class='btn btn-sm btn-outline-danger '
                           name='deletePhoto'><i class="far fa-trash-alt"></i> Delete</a>
                    </form>
                </div><hr>
            </div>
        @endforeach
    </div>
    </div>
</div>

@include('../partial/footer')

