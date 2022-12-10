<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

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
            ->select('posts.id as id','users.username','users.images','posts.posts','posts.created_at as created_at')
            ->get();
        return view('follows.followList',['posts'=>$posts,$users]);
    }


    public function followerList(){
        return view('follows.followerList');
    }


}
