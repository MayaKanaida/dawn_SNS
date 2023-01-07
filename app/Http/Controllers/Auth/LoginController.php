<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // /loginの時に実行される。＄requestの中にはlogin時に入力した値が入っている。
    public function login(Request $request){
        // もし$requestの値がpost送信された場合に実行する。
        if($request->isMethod('post')){
        // $requestのmail,passwordの値を取得して$dataに代入する。
            $data=$request->only('mail','password');
            // ＄dataの値がDBに登録されているか判定し、成功なら認証可（attemptは認証をtrueかfalseで返す）
            if(Auth::attempt($data)){
                // 認証可の場合は/topのURLを表示する。
                return redirect('/top');
            }
        }
        // post送信前と認証失敗の場合は、auth.loginファイルを表示する。
        return view("auth.login");
    }

    public function logout()
     {
        Auth::logout();
           return redirect('/login');
     }
}
