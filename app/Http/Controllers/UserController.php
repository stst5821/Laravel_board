<?php

namespace App\Http\Controllers;

use App\User;

// ↓UserControllerでPostテーブルを触るときに、宣言しておく必要がある。
use App\Post;
use App\UploadImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $user = User::find(Auth::user()->id); // 現在ログインしているユーザーのIDを使って、userテーブルからレコードを持ってくる。
        $uploads = UploadImage::find($user->image_id); // $userのimage_idカラムのデータを使って、uploadimageからレコードを持ってくる。
        $auth = Auth::user();
        
        return view('users.index',[ 
        'auth' => $auth,
        "uploads" => $uploads ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        $user = User::find($user->id); //idが、リクエストされた$userのidと一致するuserを取得

        $posts = Post::where('user_id', $user->id) //$userによる投稿を取得 UsercontrollerでPostモデルを使うために、最初にuse App\Post;でモデルの使用を宣言しておく必要がある。
            ->orderBy('created_at', 'desc') // 投稿作成日が新しい順に並べる
            ->paginate(3); // ページネーション;

        return view('users.show', [
            'user_name' => $user->name, // $user名をviewへ渡す
            'posts' => $posts, // $userの書いた記事をviewへ渡す
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }
}