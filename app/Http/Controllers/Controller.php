<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function insert(Request $request) {
        Post::create_post($request->input('title'), $request->input('content'), $request->input('tags'), $request->input('color'));
        $posts = Post::where('author_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('myblog')->with('posts', $posts);
    }

    function updateBlog(Request $request) {
        User::update_blog($request->input('about'),$request->input('color'));

        return redirect()->route('updateBlog');
    }

    function editPost(Request $request) {
        Post::edit_post($request->input('title'), $request->input('content'), $request->input('color'), $request->input('id'));
        return redirect()->route('myblog');
    }

    public function homePosts() {
        $posts = Post::orderBy('rating', 'desc')->get();
        return view('welcome')->with(['posts' => $posts]);
    }

    public function myblogPosts() {
        $posts = Post::where('author_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('myblog')->with('posts', $posts);
    }

    public function getBigbrother() {
        $users = User::orderBy('id', 'asc')->get();
        return view('bigbrother')->with('users', $users);
    }

    public function save_changes(Request $request) {
        User::save_changes($request->input('userId'), $request->input('userRole'), $request->input('userVerified'));
        return redirect()->route('bigbrother');
    }

    public function delete_user(Request $request) {
        User::delete_user($request->input('userId'));
        return redirect()->route('bigbrother');
    }

    public function getPostControl() {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('postcontrol')->with('posts', $posts);
    }

    public function delete_post(Request $request) {
        Post::delete_post($request->input('postId'));
        return redirect()->route('postcontrol');
    }

    public function getNewPosts() {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('newposts')->with('posts', $posts);
    }

    public function becomeblogger(Request $request) {
        User::give_permission($request->input('userid'));
        return view('contact');
    }

    public function delete_userpost(Request $request) {
        Post::delete_userpost($request->input('postId'));
        return redirect()->route('myblog');
    }
}
