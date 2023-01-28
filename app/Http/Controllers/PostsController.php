<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class PostsController extends Controller
{
    //web.phpのtop画面に移行した時にindexを実装する
    public function index(){
        // ＄postsのテーブルに接続する  //usersテーブルと連結する(15行目)
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            // postsテーブルのuser_idカラムがログインしているuserのidに絞る
            ->where('posts.user_id',Auth::id())
            // postsテーブルのid,username,images,posts,時間を選択（必要な情報を選択）
            ->select('posts.id as id','users.username','users.images','posts.posts','posts.created_at as created_at')
            // 全部の情報を取得
            ->get();
        // ログインしているユーザー情報を全て取得し、$auth変数に代入する
        $auth = Auth::user();

        $followCount = DB::table('follows')
            ->where('follower',Auth::id())
            ->count();

        $followerCount = DB::table('follows')
            ->where('follow',Auth::id())
            ->count();

        // return view('posts.index',['posts'=>$posts,$auth,$followCount,$followerCount]);
        return view('posts.index', compact('posts', 'auth', 'followCount', 'followerCount'));
    }

    public function create(Request $request){
       $post = $request->input('newPost');
    //    dd($post); データが正しく入っているか確認できる方法
        DB::table('posts')->insert([
            'posts' => $post,
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/top');
    }

    public function update(Request $request){
          $id = $request->input('id');
          $upPost = $request->input('upPost');
          DB::table('posts')
          ->where('id',$id)
          ->update([
            'posts' => $upPost,
        ]);
        return back();

    }

        public function delete($id){
           DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }
}
