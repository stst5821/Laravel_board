<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UploadImage;
use App\User;


class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
}