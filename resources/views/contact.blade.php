@extends('layouts.app')

@section('titleLocation')
    Contact
@endsection

@section('content')
    <div class="container-fluid" style="margin: 0px; padding: 0px; width: 100%; overflow: hidden;">
        <div class="first-background" style="margin: 0px; padding: 0px;">
            <div style="padding: 10px; padding-left: 20px; border-bottom: 1px solid black; height: 300px; width: 100%; background-color: dimgrey; background-image: url('img/landscape.gif'); background-repeat: no-repeat; background-position: center; background-size: cover;">
                <h1 style="color: white; font-size: 100px;">Contact.</h1>
            </div>
        </div>
        @if(Auth::user()->role == 'admin')
            <div class="row" style="margin: 20px; text-align: center">
                <div class="col-md-8 col-md-offset-2">
                    <span>You are an admin.</span>
                    <br>
                    <span>No need to ask.</span>
                </div>
            </div>
        @elseif(Auth::user()->role == 'author')
            <div class="row" style="margin: 20px; text-align: center">
                <div class="col-md-8 col-md-offset-2">
                    <span>You're already an Author!</span>
                    <br>
                    <span>Start blogging you dummy.</span>
                </div>
            </div>
        @elseif(Auth::user()->requested ==  'no')
        <div class="row" style="margin: 20px; text-align: center">
            <div class="col-md-8 col-md-offset-2">
                <span>Want to start a Blog?</span>
                <br>
                <span>Press the button below to enlist!</span>
                <br>
                <form action="{{route('becomeblogger')}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="userid" value="{{ Auth::user()->id }}">
                    <button class="btn btn-primary">Become a Blogger</button>
                </form>
            </div>
        </div>
        @elseif(Auth::user()->requested == 'yes')
            <div class="row" style="margin: 20px; text-align: center">
                <div class="col-md-8 col-md-offset-2">
                    <span>Your request has been submitted!</span>
                    <br>
                    <span>please check back in a couple hours.</span>
                </div>
            </div>
        @endif
    </div>
@endsection