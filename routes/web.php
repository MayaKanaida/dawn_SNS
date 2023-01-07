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
Route::get('/top','PostsController@index');

Route::post('/create','PostsController@create');

Route::post('/post/update','PostsController@update');

Route::get('/delete/{id}','PostsController@delete');

Route::get('/followList','FollowsController@followList');

Route::get('/followerList','FollowsController@followerList');

Route::get('/profile/{id}','UsersController@profile');
Route::get('/myprofile','UsersController@myprofile');

Route::post('/follow','FollowsController@follow');
Route::delete('/unfollow','FollowsController@unfollow');

Route::get('/search','UsersController@search');
Route::post('/search','UsersController@search');
