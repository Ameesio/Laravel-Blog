@extends('layouts.app')

@section('titleLocation')
    User Control
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
                        <td><a href="{{ route('bigbrother') }}" style="color: darkgrey;">User Control</a></td>
                        <td><a href="{{ route('postcontrol') }}" style="color: white;">Post Control</a></td>
                    </tr>
                </table>
            </div>
            <div class="background-banner" style="background: linear-gradient({{ Auth::user()->bannerColor }}, #FFFFFF); height: 200px; width: 100%; text-align: center;">
                <span style="font-size: 50px;">User Control</span>
            </div>
            <div class="mainContent" style="width: 100%; height: 100%; text-align: center;">
                @foreach($users as $user)
                    <?php
                       $following = explode('|', $user->following);
                    ?>
                        <form action="{{ route('save_changes') }}" method="post">
                            {{ csrf_field() }}
                            <table style="float: left; width: 80%; text-align: center; text-overflow: ellipsis">
                                <tr>
                                    <td><span style="color: red">Username: </span>{{ $user->name }}</td>
                                    <td><span style="color: red">Email: </span>{{ $user->email }}</td>
                                    <td><span style="color: red">Role: </span>
                                        <select name="userRole" id="">
                                            <option value="{{ $user->role }}">{{ $user->role }}</option>
                                            <option value="subscriber">subscriber</option>
                                            <option value="author">author</option>
                                            <option value="admin">admin</option>
                                        </select>
                                    </td>
                                    <td><span style="color: red">Banner Color: </span>{{ $user->bannerColor }}</td>
                                    <td>
                                        <span style="color: red;">Requested: <span style="@if($user->requested == 'yes')color: lightseagreen;@endif">{{ $user->requested }}</span></span>
                                    </td>
                                    <td><span style="color: red">Following: </span>
                                        <select name="" id="">
                                            @foreach($following as $follow)
                                                <option value="">{{ $follow }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                            <input type="hidden" name="userId" value="{{ $user->id }}">
                                            <button type="submit" class="btn btn-primary">Save Edit</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <form action="{{ route('delete') }}" method="post">
                            {{ csrf_field() }}
                            <td style="float: right;">
                                <input type="hidden" name="userId" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </td>
                        </form>
                        <hr>
                        <br>
                @endforeach
            </div>
        @endif
    @endif
@endsection