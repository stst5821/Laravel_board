<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
// ↓UserControllerでPostテーブルを触るときに、宣言しておく必要がある。
use App\Post;
use App\UploadImage;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    // コンストラクタ。インスタンスを生成する際に自動で呼ばれるメソッド。
    public function __construct()
    {
        $this->middleware('auth');
    }

    // これがメソッド。HomeContorollerクラスのメソッド。
    // メソッドとは、それぞれのインスタンスが持つ関数のこと。
    public function index()
    {
        $user = User::find(Auth::user()->id); //idが、リクエストされた$userのidと一致するuserを取得

        $uploads = UploadImage::find($user->image_id); // getだと全部取ってきてしまうので、1個だけの場合はfirstを使う。

        $posts = Post::where('user_id', $user->id) //$userによる投稿を取得 UsercontrollerでPostモデルを使うために、最初にuse App\Post;でモデルの使用を宣言しておく必要がある。
            ->orderBy('created_at', 'desc') // 投稿作成日が新しい順に並べる
            ->paginate(3); // ページネーション;

        return view('home', [
            'user_id' => $user->id, // $user_idをviewへ渡す
            'posts' => $posts, // $userの書いた記事をviewへ渡す
            "uploads" => $uploads
        ]);
    }
}