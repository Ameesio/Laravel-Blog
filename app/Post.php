<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    public static function create_post($title, $content, $tags, $color) {
        $post = new Post;
        $post->author_id = Auth::id();
        $post->username=  Auth::user()->name;
        $post->title = $title;
        $post->content = $content;
        $post->tags = $tags;
        $post->color = $color;
        $post->rating = 1;
        $post->created_at = date('Y-m-d ') . date('H:i:s');
        $post->updated_at = date('Y-m-d ') . date('H:i:s');
        $post->save();

        return $post;
    }

    public static function edit_post($title, $content, $color, $id) {
        DB::table('posts')
            ->where('id', $id)
            ->update([  'title' => $title,
                        'content' => $content,
                        'color' => $color,
            ]);
    }

    public static function delete_post($postId) {
        DB::table('posts')
            ->where('id', $postId)
            ->delete();
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public static function delete_userpost($postId) {
        DB::table('posts')
            ->where('id', $postId)
            ->delete();
    }
}
