@extends('layouts.app')

@section('titleLocation')
    {{ Auth::user()->name }}
@endsection

@section('content')
    @if(Auth::user()->role != 'author')
        @if(Auth::user()->role == 'admin')
            <div class="container-fluid" style="margin: 0px; padding: 0px; width: 100%; overflow: hidden;">
                <div class="background-banner" style="background: linear-gradient({{ Auth::user()->bannerColor }}, #FFFFFF); height: 200px; width: 100%; text-align: center;">
                    <span style="margin-top: 20px; font-size: 50px;">{{ Auth::user()->name }}</span><br>
                    <span style="font-size: 20px;">{{ Auth::user()->about }}</span>
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <div class="row" style="margin: 20px;">
                        <div class="create-blog" style="display: none;">
                            <form action="{{ route('insertPost') }}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                                <div class="form-group">
                                    <label for="content">Content:</label>
                                    <textarea class="form-control" rows="5" id="content" style="resize: none" name="content"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tags">Tags:</label>
                                    <input type="text" class="form-control" id="tags" name="tags">
                                    <span>(Split tags using a comma sign)</span>
                                </div>
                                <div class="form-group">
                                    <label for="tags">Color:</label>
                                    <input type="color" name="color" class="form-control" style="">
                                </div>
                                <button class="btn btn-primary" style="float: right;" type="submit">Upload Blog</button>
                            </form>

                            <br>
                            <br>
                        </div>
                        <br>
                        <br>

                        <div id="extend" style="text-align: center; background-color: #222222; color: white; font-size: 20px; cursor: pointer;" onclick="slideBlog()"><span id="textje" style="">New Blog</span></div>
                        <br>
                        <br>
                        <span style="font-family: 'Tahoma'; font-size: 20px;">Your latest blogs!</span>
                        <br>
                        <br>
                        <div class="your-blogs">
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
                                    <div class="showMore" onclick="$('.post{{ $post->id }} .extendPost').animate({height:'toggle'},350);" style="background: linear-gradient(to right,#286090, #7BAAF7); border: 1px solid black; border-top: none; color: white; font-family: 'Tahoma'; font-size: 15px; width: 100%; height: 25px; text-align: center; cursor: pointer;">
                                        <span>Show more!</span>
                                    </div>
                                    <div class="extendEdit{{$post->id}}" style="display: none; border: 1px solid black; border-top: none; padding: 10px;">
                                        <form action="{{ route('editPost') }}" method="post">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="title">Title:</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="content">Content:</label>
                                                <textarea class="form-control" rows="5" id="content" style="resize: none" name="content">{{ $post->content }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="tags">Color:</label>
                                                <input type="color" value="{{ $post->color }}" name="color" class="form-control" style="">
                                            </div>
                                            <input type="hidden" name="id" value="{{ $post->id }}">
                                            <button class="btn btn-primary" style="" type="submit">Update Post</button>
                                        </form>
                                    </div>
                                    <div class="rating" style="float: left;">
                                        <span>{{ $post->rating }} Likes</span>
                                        <div style="font-size: 15px; margin-left: 5px; margin-top: 3px; cursor: pointer;" class="glyphicon glyphicon-thumbs-up" aria-hidden="true" onclick="alert('User: {{ Auth::id() }} Likes this')"></div>
                                    </div>
                                    <div class="edit" style="float: right;">
                                            <button onclick="$('.extendEdit{{ $post->id }}').animate({height:'toggle'});" style="cursor: pointer;" class="fa fa-pencil" aria-hidden="true" id="edit{{ $post->id }}"></button>
                                        <form action="{{ route('deletePost') }}" method="post">
                                            <input type="hidden" value="{{ $post->id }}">
                                            <button type="submit" style="cursor: pointer; margin-right: 10px; margin-left: 10px;" id="delete{{ $post->id }}" class="fa fa-trash" aria-hidden="true"></button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <script>
                    function slideBlog() {
                        $('.create-blog').slideToggle("slow");
                        if($('#textje').text() == 'New Blog') {
                            $('#textje').text('Close');
                        }
                    }
                </script>
        @else
            <span>You are not permitted to start a blog. click <a href="{{ route('home') }}"> HERE </a> to return. or click <a href=""> HERE </a> to request blog permission.</span>
        @endif
    @else
                    <div class="container-fluid" style="margin: 0px; padding: 0px; width: 100%; overflow: hidden;">
                        <div class="background-banner" style="background: linear-gradient({{ Auth::user()->bannerColor }}, #FFFFFF); height: 200px; width: 100%; text-align: center;">
                            <span style="margin-top: 20px; font-size: 50px;">{{ Auth::user()->name }}</span><br>
                            <span style="font-size: 20px;">{{ Auth::user()->about }}</span>
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            <div class="row" style="margin: 20px;">
                                <div class="create-blog" style="display: none;">
                                    <form action="{{ route('insertPost') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="title">Title:</label>
                                            <input type="text" class="form-control" id="title" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Content:</label>
                                            <textarea class="form-control" rows="5" id="content" style="resize: none" name="content"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="tags">Tags:</label>
                                            <input type="text" class="form-control" id="tags" name="tags">
                                            <span>(Split tags using a comma sign)</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="tags">Color:</label>
                                            <input type="color" name="color" class="form-control" style="">
                                        </div>
                                        <button class="btn btn-primary" style="float: right;" type="submit">Upload Blog</button>
                                    </form>

                                    <br>
                                    <br>
                                </div>
                                <br>
                                <br>

                                <div id="extend" style="text-align: center; background-color: #222222; color: white; font-size: 20px; cursor: pointer;" onclick="slideBlog()"><span id="textje" style="">New Blog</span></div>
                                <br>
                                <br>
                                <span style="font-family: 'Tahoma'; font-size: 20px;">Your latest blogs!</span>
                                <br>
                                <br>
                                <div class="your-blogs">
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
                                            <div class="showMore" onclick="$('.post{{ $post->id }} .extendPost').animate({height:'toggle'},350);" style="background: linear-gradient(to right,#286090, #7BAAF7); border: 1px solid black; border-top: none; color: white; font-family: 'Tahoma'; font-size: 15px; width: 100%; height: 25px; text-align: center; cursor: pointer;">
                                                <span>Show more!</span>
                                            </div>
                                            <div class="extendEdit{{$post->id}}" style="display: none; border: 1px solid black; border-top: none; padding: 10px;">
                                                <form action="{{ route('editPost') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label for="title">Title:</label>
                                                        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="content">Content:</label>
                                                        <textarea class="form-control" rows="5" id="content" style="resize: none" name="content">{{ $post->content }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tags">Color:</label>
                                                        <input type="color" value="{{ $post->color }}" name="color" class="form-control" style="">
                                                    </div>
                                                    <input type="hidden" name="id" value="{{ $post->id }}">
                                                    <button class="btn btn-primary" style="" type="submit">Update Post</button>
                                                </form>
                                            </div>
                                            <div class="rating" style="float: left;">
                                                <span>{{ $post->rating }} Likes</span>
                                                <div style="font-size: 15px; margin-left: 5px; margin-top: 3px; cursor: pointer;" class="glyphicon glyphicon-thumbs-up" aria-hidden="true" onclick="alert('User: {{ Auth::id() }} Likes this')"></div>
                                            </div>
                                            <div class="edit" style="float: right;">
                                                <button onclick="$('.extendEdit{{ $post->id }}').animate({height:'toggle'});" style="cursor: pointer;" class="fa fa-pencil" aria-hidden="true" id="edit{{ $post->id }}"></button>
                                                <form action="{{ route('deletePost2') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="postId" value="{{ $post->id }}">
                                                    <button type="submit" style="cursor: pointer;" id="delete{{ $post->id }}" class="fa fa-trash" aria-hidden="true"></button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
        <script>
            function slideBlog() {
                $('.create-blog').slideToggle("slow");
                if($('#textje').text() == 'New Blog') {
                    $('#textje').text('Close');
                }

            }
        </script>
    @endif
@endsection