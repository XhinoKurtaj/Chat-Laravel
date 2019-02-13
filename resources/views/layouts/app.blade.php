<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <style>
        .button-conv{
            font-size:20px;
            font-family: "Times New Roman", Times, serif;
        }
        .button-conv:hover{
            color:orangered;
                 }

        .img-thumbnail{
            height: 200px;
            width: 200px;
            word-wrap: break-word;
        }

        .col-2 {
            -moz-hyphens:auto;
            -ms-hyphens:auto;
            -webkit-hyphens:auto;
            hyphens:auto;
            word-wrap:break-word;
        }
        .ahref-style
        {
            font-size: 15px;
            width:200px;
            height:200px;
            border:1px solid red;
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
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            {{--==================================================================================================================================--}}
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:50px;">
                                <img src="/storage/{{ Auth::user()->photo }}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            {{--===================================================================================================================================--}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name." ".Auth::user()->last_name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->type == 'admin')
                                    <a class="dropdown-item" href="{{  route('admin') }}">Admin</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i> Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        $(window).on('load', function() {
            getAttachment();
            getMembers();
        });
        function getAttachment() {
            var id = $("#conversation-id").val();
            const attachmentList = $("#attachment-list");
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "GET",
                url: '/home/conversation/'+id+'/attachment',
                success: function (result) {
                    var output = "";
                    for (var i in result) {
                        var mimeType = result[i].attachment;
                        if (mimeType.includes(".jpg") || mimeType.includes(".jpeg") || mimeType.includes(".png") || mimeType.includes(".gif")) {
                            output += "<div class='column'><a href='/home/conversation/"+id+"/download/"+result[i].id+"'>" +
                                "<img src='/storage/" + mimeType + "' class='img-thumbnail'></a></div>";
                    }else{
                            output += "<div class='column ahref-style'><a style='text-decoration:none' href='/home/conversation/"+id+"/download/"+result[i].id+"'>"+result[i].attachment + "<br><br>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp" +
                                "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<i class='fas fa-download' style='color:gray'></i></a></div>";
                        }
                }
                attachmentList.html(output);
            }
        });
    }

        function getMembers(){
            var id = $("#conversation-id").val();
            const memeberDisplay = $("#showMemberList");
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "GET",
                url: '/home/conversation/'+id +'/members',
                success:function(data){
                    var output = "";
                    for(var i in data){
                        output += "<tr class='table-active'>"+
                            "<td><strong><a href='/users/"+data[i].id+"'>"+data[i].fullName +"</a></strong></td></tr>";
                    }
                    memeberDisplay.html(output);
                }
            });
        }
</script>
</body>
</html>


