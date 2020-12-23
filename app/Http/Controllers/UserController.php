<?php

namespace App\Http\Controllers;

use App\User;

// ↓UserControllerでPostテーブルを触るときに、宣言しておく必要がある。
use App\Post;
use App\UploadImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        'user' => $user,
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
    public function edit($id)
    {
        // URLパラメータから取得した記事idを使って、postsテーブルからレコードを取得して、$postに代入している。
        $user = DB::table('users')->where('id', $id)->first();

        // ログインしているユーザのidと、$userのuser_idを比較して、同じならedit画面に進む。違うならuser$userのindex画面にリダイレクトさせる。
        // これをcontrollerに書いておかないと、URLに直接http://127.0.0.1:8000/user$users/edit/6 と入力した場合、別のユーザーが書いた記事の編集画面に入れてしまう。
        if (Auth::user()->id == $user->id) {
        return view('users.edit',['user' => $user,'id' =>$id]);
        } 
        else {
        return redirect()->to('/users');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        
        //レコードを検索
        $user = User::findOrFail($id);
        $user->name = $request->name;
        
        //保存（更新）
        $user->save();
        
        return redirect()->to('/users/index');
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