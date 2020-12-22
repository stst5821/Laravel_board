<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all()->sortByDesc('id'); //Postモデルを使って、データをDBから取得している。sortByDesc('カラム名')でidの大きい順に並べ替え。orderbyでは駄目なので注意。
        return view('posts.index', ['posts' => $posts]);
        // postsディレクトリのindexビューに値を返す。['viewで使える変数' => $アクションで指定した変数(2行上で指定した変数のこと)]
    }

/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::id();
        //インスタンス作成
        $post = new Post();
        
        $post->body = $request->body;
        $post->user_id = $id;

        $post->save();

        return redirect()->to('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */

    // show(Postモデル $post)なのかな？
    // ルーティングから自動的にidを拾ってきて、Postモデルを使ってレコードを取得し、変数($post)に代入している。
    public function show(Post $post)
    {
        $usr_id = $post->user_id;
        $user = DB::table('users')->where('id', $usr_id)->first();
        

        return view('posts.detail',['post' => $post,'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    
    // edit(ルートパラメータが入る？/{$id}←これ)
    public function edit($id)
    {
        // URLパラメータから取得した記事idを使って、postsテーブルからレコードを取得して、$postに代入している。
        $post = DB::table('posts')->where('id', $id)->first();
        
        // ログインしているユーザのidと、$postのuser_idを比較して、同じならedit画面に進む。違うならpostのindex画面にリダイレクトさせる。
        // これをcontrollerに書いておかないと、URLに直接http://127.0.0.1:8000/posts/edit/6 と入力した場合、別のユーザーが書いた記事の編集画面に入れてしまう。
        if (Auth::user()->id == $post->user_id) {
        return view('posts.edit',['post' => $post,'id' =>$id]);
        } 
        else {
        return redirect()->to('/posts');
        }
    }

    public function update(Request $request)
    {
        $id = $request->post_id;
        
        //レコードを検索
        $post = Post::findOrFail($id);
        $post->body = $request->body;
        
        //保存（更新）
        $post->save();
        
        return redirect()->to('/posts');
    }


    public function destroy($id)
    {
        $post = Post::find($id);
        //削除
        $post->delete();

        return redirect()->to('/posts');
    }
}