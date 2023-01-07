<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class UsersController extends Controller
{
    //
    public function profile($id){
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.user_id', $id)
            ->select('users.id as id','users.username','users.images', 'users.bio', 'posts.posts','posts.created_at as created_at')
            ->get();
        $auth = Auth::user();

        $followCount = DB::table('follows')
            ->where('follower',Auth::id())
            ->count();

        $followerCount = DB::table('follows')
            ->where('follow',Auth::id())
            ->count();
        $followNumbers = DB::table('follows')
            ->where('follower', Auth::id())
            ->pluck('follow');

        return view('users.profile',compact('posts', 'auth', 'followCount', 'followerCount', 'followNumbers'));
    }
    public function search(Request $request){


        $auth = Auth::user();

        $followCount = DB::table('follows')
            ->where('follower',Auth::id())
            ->count();

        $followerCount = DB::table('follows')
            ->where('follow',Auth::id())
            ->count();

        $followNumbers = DB::table('follows')
            ->where('follower', Auth::id())
            ->pluck('follow');


        $keyword = $request->input('keyword');

        if ($keyword)
        {
            $users_list = DB::table('users')
                ->where('username', 'like',"%$keyword%")
                ->where('id', '<>', Auth::id())
                ->select('id', 'username', 'images')
                ->get();
        }
        else {
            $users_list = DB::table('users')
                ->where('id', '<>', Auth::id())
                ->select('id', 'username', 'images')
                ->get();
        }


        return view('users.search',compact('auth', 'followCount', 'followerCount', 'keyword', 'users_list','followNumbers'));
    }

    public function myprofile(){
       $user=Auth::user();

        return view('users.myprofile',compact('user'));
    }
}
