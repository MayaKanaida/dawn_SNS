<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'password-confirm' => ['required', 'min:4', 'same:password'],
        ],
        [
            'username.required' => '必須項目です!',
            'username.between:4,12' => '4文字以上12文字以内で入力してください',
            'mail.required' => '必須項目です',
		    'mail.email' => 'メールアドレスではありません',
            'mail.between:4,12' => '4文字以上12文字以内で入力してください',
		    'password.required' => '必須項目です',
		    'password.min' => '4文字以上12文字以内で入力してください',
            'password-confirm.between:4,12' => '4文字以上12文字以内で入力してください',
		    'password-confirm.same' => 'パスワードと確認用パスワードが一致していません',
        ]
    );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();

            $val = $this->validator($data);
            if($val->fails()){
                return redirect('register')
                ->withErrors($val);
            }else{
                $this->create($data);
                return redirect('added');
            }
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
