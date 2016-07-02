<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Mailz! </title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}?{{crc32(file_get_contents('css/app.css'))}}">

</head>
<body id="app-layout">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Mailz!
            </a>

        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                {{--<li><a href="{{ url('/home') }}">Home</a></li>--}}
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}"><i class="glyphicon glyphicon-log-in"></i> Login / Register</a>
                    </li>
                @else
                    <li>
                        <a>
                            <sub>Last Login {{Auth::user()->last_login}} ago</sub>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->nick }}
                            {{--<span class="caret"></span>--}}
                            <img src="{{Auth::user()->avatar}}" class="img-circle img-responsive avatar"/>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/profile') }}"><i class="glyphicon glyphicon-user"></i> Profile</a>
                            </li>
                            <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                    @if(Auth::user()->background)
                        <style>
                            body {
                                background: url('{{Auth::user()->background}}');
                            }
                        </style>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/summernote.min.js')}}"></script>
<script src="{{asset('js/vue.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>

@stack('scripts')


</body>
</html>
