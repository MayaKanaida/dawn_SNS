<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //
    public function followList(){
        $users = DB::table('users')
            ->join('follows','users.id','=','follows.follow')
            ->where('follows.follower',Auth::id())
            ->select('users.id', 'users.images')
            ->get();
         $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->join('follows','posts.user_id','=','follows.follow')
            ->where('follows.follower',Auth::id())
            ->select('posts.id as id', 'users.id as uid', 'users.username', 'users.images', 'posts.posts', 'posts.created_at as created_at')
            ->get();

        $auth = Auth::user();

        $followCount = DB::table('follows')
            ->where('follower',Auth::id())
            ->count();

        $followerCount = DB::table('follows')
            ->where('follow',Auth::id())
            ->count();

        return view('follows.followList', compact('users', 'posts', 'auth', 'followCount', 'followerCount'));
    }

    public function followerList(){
        $users = DB::table('users')
            ->join('follows','users.id','=','follows.follower')
            ->where('follows.follow',Auth::id())
            ->select('users.id', 'users.images')
            ->get();
         $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->join('follows','posts.user_id','=','follows.follower')
            ->where('follows.follow',Auth::id())
            ->select('posts.id as id', 'users.id as uid', 'users.username', 'users.images', 'posts.posts', 'posts.created_at as created_at')
            ->get();

        $auth = Auth::user();

        $followCount = DB::table('follows')
            ->where('follower',Auth::id())
            ->count();

        $followerCount = DB::table('follows')
            ->where('follow',Auth::id())
            ->count();
        return view('follows.followerList',compact('users', 'posts', 'auth', 'followCount', 'followerCount'));
    }

    public function follow(Request $request){
        $follow_id = $request->follow_id;
        $my_id = Auth::id();
        DB::table('follows')
        ->insert([
            'follow' => $follow_id,
            'follower' => $my_id,
            'created_at' => now(),
        ]);
        return back();
    }

    public function unfollow(Request $request){
        $follow_id = $request->follow_id;
        $my_id = Auth::id();
        DB::table('follows')
        // whereで消すべきレコードのみ取得（無いと全てのレコードが消えて全員のフォローが外れてしまう）
        ->where([
            'follow' => $follow_id,
            'follower' => $my_id,
        ])->delete();
        return back();
    }


}
