<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/URL', '飛ばしたい先のController@アクション名')->name('これを決めておくと、viewのリンクでこの名前を使えるようになる。');
Route::get('/home', 'HomeController@index')->name('home');

// パスワード変更
Route::get('/password/change', 'Auth\ChangePasswordController@showChangePasswordForm')->name('password.form');
Route::post('/password/change', 'Auth\ChangePasswordController@ChangePassword')->name('password.change');


// 投稿ページ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝


// onlyを使うと、Postcontrollerのどのviewを表示するか指定できる。全部表示していい場合は、onlyは消していい
Route::resource('/posts', 'PostController', ['only' => ['index','show','create','store']]);

Route::get('posts/edit/{id}', 'PostController@edit');
Route::post('posts/edit', 'PostController@update');
Route::post('posts/destroy/{id}', 'PostController@destroy');

// ->name("user_index");を記述することで、Viewでroute('')を使うことができる。
Route::get('/users/index', 'UserController@index')->name("user_index");

Route::resource('/users', 'UserController', ['only' => ['show']]);


// 画像アップロード＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝


Route::get('/form', 
	[App\Http\Controllers\UploadImageController::class, "show"]
	)->name("upload_form");

Route::post('/upload', 
	[App\Http\Controllers\UploadImageController::class, "upload"]
    )->name("upload_image");
    
// 画像一覧

Route::get('/list', 
	[App\Http\Controllers\ImageListController::class, "show"]
	)->name("image_list");