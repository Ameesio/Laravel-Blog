@extends('layouts.app')

@section('titleLocation')
    Account-Settings
@endsection

@section('content')
    <div class="container-fluid" style="margin: 0px; padding: 0px; width: 100%; overflow: hidden;">
        <form action="{{ route('updateBlog') }}" method="post">
            {{ csrf_field() }}
            <div  style="position: absolute; padding: 10px;" class="form-group">
                <input class="form-control" value="{{ Auth::user()->bannerColor }}" style="position: absolute; width: 50px; padding: 0px;" type="color" name="color">
            </div>
            <div class="background-banner" style="border-bottom: 1px solid black; background: linear-gradient({{ Auth::user()->bannerColor }}, #FFFFFF); height: 200px; width: 100%; text-align: center;">
                <span style="margin-top: 20px; font-size: 50px;">{{ Auth::user()->name }}</span><br>
                <span style="font-size: 20px;">{{ Auth::user()->about }}</span>
            </div>
        <div class="row" style="margin: 20px;">
            <div class="col-md-8 col-md-offset-2">
                <div class="form-group">
                    <label for="about">About:</label>
                    <textarea name="about" class="form-control" style="resize: none;">{{ Auth::user()->about }}</textarea>
                </div>
                <button class="btn btn-primary" style="float: right;" type="submit">Update Blog</button>
        </div>
    </div>
    </form>
@endsection