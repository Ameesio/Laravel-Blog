@extends('layouts.app')

@section('titleLocation')
    Post Control
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
                        <td><a href="{{ route('postcontrol') }}" style="color: darkgrey;">Post Control</a></td>
                    </tr>
                </table>
            </div>
            <div class="background-banner" style="background: linear-gradient({{ Auth::user()->bannerColor }}, #FFFFFF); height: 200px; width: 100%; text-align: center;">
                <span style="font-size: 50px;">Post Control</span>
            </div>
            <div class="mainContent" style="width: 100%; height: 100%; text-align: center;">
                @foreach($posts as $post)
                <form action="{{ route('deletePost') }}" method="post">
                    {{ csrf_field() }}
                    <table style="width: 80%; text-align: center; text-overflow: ellipsis">
                        <tr>
                            <td><span style="color: red">Author: </span>{{ $post->username }}</td>
                            <td><span style="color: red">Title: </span>{{ $post->title }}</td>
                            <td><span style="color: red">Content: </span>{{ $post->content }}</td>
                            <td><span style="color: red">Tags: </span>{{ $post->tags }}</td>
                            <td><span style="color: red">Rating: </span>{{ $post->rating }}</td>
                            <td>
                                <input type="hidden" name="postId" value="{{ $post->id }}">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    </table>
                    <hr>
                </form>
                @endforeach
            </div>
        @endif
    @endif
@endsection