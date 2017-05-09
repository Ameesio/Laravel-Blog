<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" style="height: 100%; width: 100%; padding: 0px; margin: 0px;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A laravel blog">
    <meta name="author" content="Mees Venema">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>X-Ploration Blog | @yield('titleLocation')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};

        function toggleThis() {
            $(".rightMenu").animate({width:'toggle'},350);
            $(".blur").fadeIn(350);
        }

        function hideAll() {
            $(".rightMenu").animate({width:'hide'},350);
            $(".blur").fadeOut(350);
        }
    </script>


</head>
<div class="blur" onclick="hideAll()" style="background-color: rgba(0,0,0,0.4); height: 100%; width: 100%; position: fixed; z-index: 10; display:none;"></div>
<body style="height: 100%; width: 100%; margin: 0px; padding: 0px;">
    <div id="app" style=" margin: 0px; padding: 0px;">
        @if(!Auth::guest())
            <div class="rightMenu" style="padding-top: 40px;height: 100%; position: fixed; width: 350px; right:0px; z-index: 11; background-color: white; border-left: 1px solid black; display: none;">
                <h1 style="color: black; font-size: 20px;text-align: center">Your Followed X-Plorers: </h1>
            </div>
        @else
            <div class="rightMenu" style="padding-top: 40px;height: 100%; position: fixed; width: 350px; right:0px; z-index: 10; background-color: white; border-left: 1px solid black; display: none;">
                <h1 style="text-align: center; color: black; font-size: 20px;">You need to <a href="{{ route('login') }}">Log-In</a> first.</h1>
            </div>
        @endif

        <nav class="navbar navbar-inverse navbar-static-top" style=" margin: 0px; padding: 0px;">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span>X-Ploration Blog | @yield('titleLocation')</span>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('featured') }}" style="color: yellow" onmouseenter="$(this).css('color', 'white');" onmouseleave="$(this).css('color', 'yellow');">Featured X-Plorers <i class="fa fa-star" aria-hidden="true"></i></a></li>
                        <li><a href="{{ route('newposts') }}" style="color: orange" onmouseenter="$(this).css('color', 'white');" onmouseleave="$(this).css('color', 'orange');">New Posts <i class="fa fa-globe" aria-hidden="true"></i></a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <ul class="nav navbar-nav navbar-right">
                        </ul>
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                            @if(Auth::user()->role == 'author')
                                                <a href="{{ route('myblog') }}">
                                                    My Blog
                                                </a>
                                            @elseif(Auth::user()->role == 'admin')
                                                <a href="{{ route('myblog') }}">
                                                    My Blog
                                                </a>
                                            @endif
                                        <a style="cursor: pointer;" onclick="toggleThis()">
                                            Subscribed X-Plorers
                                        </a>
                                        <a href="{{ route('contact') }}">
                                            Contact
                                        </a>
                                        @if(Auth::user()->role == 'admin')
                                            <a href="{{ route('adminpanel') }}">
                                            Admin Panel
                                        </a>
                                        @else

                                        @endif
                                                @if(Auth::user()->role == 'author')
                                                    <a href="{{ route('accountSettings') }}">
                                                        Account-Settings
                                                    </a>
                                                @elseif(Auth::user()->role == 'admin')
                                                    <a href="{{ route('accountSettings') }}">
                                                        Account-Settings
                                                    </a>
                                                @endif
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
