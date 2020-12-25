<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UploadImage;
use App\User;

use App\Http\Requests\ChangeNameRequest; // Http/Requests/ChangeNameRequest.phpを使うための宣言


class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ユーザー情報一覧

    public function index()
    {
        $auth = Auth::user();
        $user = User::find(Auth::user()->id); // 現在ログインしているユーザーのIDを使って、userテーブルからレコードを持ってくる。
        $uploads = UploadImage::find($user->image_id); // $userのimage_idカラムのデータを使って、uploadimageからレコードを持ってくる。

        return view('setting.index',
            ['auth' => $auth,
            'uploads' => $uploads
            ]);
    }

    // 名前変更

    public function showChangeNameForm()
    {
        $auth = Auth::user();
        return view('setting.name', ['auth' => $auth]);
    }

    public function changeName(ChangeNameRequest $request)
    {
        //ValidationはChangeNameRequestで処理
        //氏名変更処理
        $user = Auth::user();
        $user->name = $request->get('name');
        $user->save();
        //homeにリダイレクト
        return redirect()->route('setting')->with('status', __('Your name has been changed.'));
    }
}