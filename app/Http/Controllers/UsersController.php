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

        $profile_user = DB::table('users')
        ->where('id',$id)
        ->first();

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

        return view('users.profile',compact('posts', 'auth', 'followCount', 'followerCount', 'followNumbers','profile_user'));
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
       $auth=Auth::user();

       $followCount = DB::table('follows')
            ->where('follower',Auth::id())
            ->count();

        $followerCount = DB::table('follows')
            ->where('follow',Auth::id())
            ->count();

        return view('users.myprofile',compact('auth', 'followCount', 'followerCount'));
    }

//↓既存のプロフィール内容を変更する場合の記述↓

    public function profileUpdate(Request $request){
        //①①$requestに入っている値をそれぞれ固有の変数に入れる
        $username = $request->username;
        $mail = $request->mail;
        $bio = $request->bio;


   //②パスワードが新たに入力されていればそれを、入力されていなければ元のパスワードをそのまま流用
        if($request->password){
            $password = bcrypt($request->password);
        }else {
            $password = DB::table('users')
            ->where('id',Auth::id())
            ->pluck('password');
        }

   //③イメージがアップロードされていればそれを、アップロードされていなければ元のイメージをそのまま流用
        if($request->iconimage){
            // イメージをアップロードする時は、イメージの名前を保存（MyAdmin参照）
            $image = $request->file('iconimage')->getClientOriginalName();
            $request->file('iconimage')->storeAs('', $image, 'public');
        }else {
            $image = DB::table('users')
                ->where('id',Auth::id())
                ->pluck('images');
        }

        //④更新処理
        DB::table('users')
        ->where('id',Auth::id())
        ->update([
            'username' => $username,
            'mail' => $mail,
            'password' => $password,
            'images' => $image,
            'bio' => $bio,
        ]);
       return redirect("/myprofile");
    }
}
