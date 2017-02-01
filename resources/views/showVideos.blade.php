<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/css/app.css">

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <!-- Styles -->
    <style>
        html, body {
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            /*text-transform: uppercase;*/
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div id="homepage">

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">ACADA</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                {{--<div class="nav navbar-nav  navbar-right form-group video-category">--}}
                    {{--<select name="" id="" class="form-control" v-model="category"  @change.prevent="getVideoUnderCategory">--}}
                        {{--<option value="" selected disabled>Video Category</option>--}}
                        {{--<option value="web">Web Development</option>--}}
                        {{--<option value="mobile">Mobile</option>--}}
                        {{--<option value="game">Game Development</option>--}}
                        {{--<option value="pc">PC</option>--}}
                        {{--<option value="android">Android Development</option>--}}
                        {{--<option value="testing">Testing</option>--}}
                        {{--<option value="dev-ops">Dev Ops</option>--}}
                    {{--</select>--}}
                {{--</div>--}}

                <ul class="nav navbar-nav navbar-right">
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @if (Auth::check())
                                <a href="{{ url('/home') }}">Home</a>
                            @else
                                <a href="{{ url('/login') }}">Login</a>
                                <a href="{{ url('/register') }}">Register</a>
                            @endif
                        </div>
                    @endif

                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default" style="height: 500px;">
                    <div class="panel-body" style="height:440px;">
                        <div class="row" style="height:100%">
                            <iframe src="{{$video->url}}" frameborder="0" class="play-video"></iframe>
                            <hr>
                            <span class="video-name">{{$video->name}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="row">
                    @if(!empty($related))
                    @foreach($related as $video)
                    <div class="col-sm-2 video-listing"
                         class="{{$video->category->categories}}" @click.prevent="playVideo(video)">

                        <img src="" alt="">
                        <div>
                            <span> Name : {{$video->name}}</span><br>
                            <span> Category: {{$video->category->categories}}</span>
                        </div>
                    </div>
                        @endforeach
                        @endif
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <iframe :src="currentVideo.url" frameborder="0" class="play-video"></iframe>
                </div>
                <div class="modal-footer">
                    <span class="video-name">@{{currentVideo.name}}</span>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="/js/homepage.js"></script>
</html>
