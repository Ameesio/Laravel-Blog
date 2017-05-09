@extends('layouts.app')

@section('titleLocation')
    Admin Panel
@endsection

@section('content')
    @if(Auth::user() == '')
            <span>You are not logged in! >:(</span>
        @else

        @if(Auth::user()->role != 'admin')
            <span>You do not have the correct authority. click <a href="{{ route('home') }}"> HERE </a> to return.</span>
        @else
            <div id="sidebar-wrapper" style="background-color: #353535; float: left; height: 100%; width: 100%; font-size: 20px; padding: 10px;">
                <table class="sidebar-nav" style="margin-top: 10px; text-align: center; width: 20%">
                    <tr style="margin-bottom: 5px; width: 100%;">
                        <td><a href="{{ route('bigbrother') }}" style="color: white;">User Control</a></td>
                        <td><a href="{{ route('postcontrol') }}" style="color: white;">Post Control</a></td>
                    </tr>
                </table>
            </div>
            <div class="background-banner" style="background: linear-gradient({{ Auth::user()->bannerColor }}, #FFFFFF); height: 200px; width: 100%; text-align: center;">
            </div>
            <div class="mainContent" style="width: 100%; height: 100%; text-align: center;">
                <span id="welcome" style="font-size: 50px;">Welcome</span><br>
                <span id="name" style="font-size: 20px;">{{ Auth::user()->name }}</span><br>
                <span style="font-size: 40px;">To your Admin duty</span>
            </div>
        @endif
    @endif
@endsection