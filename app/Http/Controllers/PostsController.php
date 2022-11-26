<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class PostsController extends Controller
{
    //
    public function index(){
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.user_id',Auth::id())
            ->select('posts.id as id','users.username','users.images','posts.posts','posts.created_at as created_at')
            ->get();
        return view('posts.index',['posts'=>$posts]);
    }

    public function create(Request $request){
       $post = $request->input('newPost');
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
}
