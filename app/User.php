<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function update_blog($about, $color) {

        $user = Auth::id();

        DB::table('users')
            ->where('id', $user)
            ->update(['about' => $about,
                      'bannerColor' => $color
            ]);
    }

    public static function save_changes($userid, $role) {
        DB::table('users')
            ->where('id', $userid)
            ->update([  'role' => $role,
            ]);
    }

    public static function delete_user($userId) {
        DB::table('users')
            ->where('id', $userId)
            ->delete();
    }

    public static function give_permission($userid) {
        DB::table('users')
            ->where('id', $userid)
            ->update(['requested' => 'yes']);
    }
}
