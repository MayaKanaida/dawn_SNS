<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ

// URLが/loginの時は、LoginControllerのloginメソッドを実行する
Route::get('/login', 'Auth\LoginController@login');
// ログイン画面前、post送信後
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');

Route::get('/logout', 'Auth\LoginController@logout');


//ログイン中のページ

//トップページ画面遷移
Route::get('/top','PostsController@index');

//投稿機能
Route::post('/create','PostsController@create');
//投稿更新
Route::post('/post/update','PostsController@update');
//投稿機能
Route::get('/delete/{id}','PostsController@delete');

//フォローフォロワーページ遷移
Route::get('/followList','FollowsController@followList');
Route::get('/followerList','FollowsController@followerList');

//他人のプロフィール画面遷移
Route::get('/profile/{id}','UsersController@profile');
//プロフィール画面遷移
Route::get('/myprofile','UsersController@myprofile');
//プロフィール更新
Route::post('/myprofile/update','UsersController@profileUpdate');

//フォローフォロワー機能
Route::post('/follow','FollowsController@follow');
Route::delete('/unfollow','FollowsController@unfollow');

//検索画面遷移
Route::get('/search','UsersController@search');
//検索機能
Route::post('/search','UsersController@search');
