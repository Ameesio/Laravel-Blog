@extends('layouts.app')

@section('titleLocation')
    Home
@endsection

@section('content')
    <div class="container-fluid" style="margin: 0px; padding: 0px; width: 100%; overflow: hidden;">
        <div class="first-background" style="margin: 0px; padding: 0px;">
            <div style="padding: 10px; padding-left: 20px; border-bottom: 1px solid black; height: 300px; width: 100%; background-color: dimgrey; background-image: url('img/landscape.gif'); background-repeat: no-repeat; background-position: center; background-size: cover;">
                <h1 style="color: white; font-size: 100px;">X-Plore.</h1>
            </div>
        </div>
        <div class="row" style="margin: 20px;">
            <div class="col-md-8 col-md-offset-2">
                @foreach($posts as $post)
                    <div class="post{{ $post->id }}">
                        <table style="display: block; border-top-left-radius: 10px; border-top-right-radius: 10px; border: 1px solid black; width: 100%; max-height: 120px; padding: 20px; overflow: hidden; background: linear-gradient(to left,{{ $post->color }}, #FFFFFF);">
                            <tr style="">
                                <td style="font-size: 25px; font-family: 'Tahoma';filter: brightness(85%);">{{ $post->title }}</td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Tahoma';filter: brightness(85%);">By: {{ $post->username }}</td>
                            </tr>
                        </table>
                        <div style="border: 1px solid black; border-top: none; display: none; padding: 20px;" class="extendPost">
                            <span>{{ $post->content }}</span>
                            <br>
                            <hr>
                            <div>
                                <span>Created by: </span>
                                <a name="user{{ $post->author_id }}" style="background-color: lightgrey; cursor: pointer; padding: 5px; border-radius: 5px;">
                                    {{ $post->username }}
                                    <i class="fa fa-check-circle-o" aria-hidden="true" style="color:deepskyblue"></i>
                                </a>
                            </div>
                        </div>
                        <div class="commentSection{{ $post->id }}" style="display: none; border: 1px solid black; border-top: none; padding: 20px;">
                            @foreach($post->comments as $comment)
                                <div class="indivComment" style="border: 1px solid black; border-radius: 10px; padding: 5px;">
                                    <span style="margin-bottom: 5px"><span>From: </span>{{ $comment->from_user }}</span>
                                    <br><br>
                                    <span><span>Message: </span><br>{{ $comment->content }}</span>
                                    <br><br>
                                    <button style="float: right;" class="btn btn-primary">Reply</button>
                                    <span style="Float: right;">{{ $comment->created_at }}</span>
                                </div>
                                <br><br>
                            @endforeach
                        </div>
                    </div>
                        <div class="showMore" onclick="$('.post{{ $post->id }} .extendPost').animate({height:'toggle'},350);" style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; background: linear-gradient(to right,#286090, #7BAAF7); border: 1px solid black; border-top: none; color: white; font-family: 'Tahoma'; font-size: 15px; width: 100%; height: 25px; text-align: center; cursor: pointer;">
                            <span>Show more!</span>
                        </div>
                        <div>
                        <div class="rating" style="float: left;">
                            <span>{{ $post->rating }} Likes</span>
                            <div style="font-size: 15px; margin-left: 5px; margin-top: 3px; cursor: pointer;" class="glyphicon glyphicon-thumbs-up" aria-hidden="true" onclick="alert('User: {{ Auth::id() }} Likes this')"></div>
                        </div>
                        <div class="comments" style="float: right; cursor: pointer;" onclick="$('.commentSection{{ $post->id }}').animate({height:'toggle'},350);">
                            <span><span id="commentsNumber"></span> Comments</span>
                            <i class="fa fa-commenting-o" aria-hidden="true"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

