<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest; // ←パスワードのハッシュ化に必要なIlluminate\Support\Facades\Hash;が書かれているので、このコントローラーでも使える。
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    // ログインしていない場合、編集画面に入れないようにする。
    public function __construct()
    {
        $this->middleware('auth');

        // メール認証していない場合、ページを表示できないようにする。
        $this->middleware('verified');
    }

    public function showChangePasswordForm()
    {
        return view('auth/passwords/change');
    }
    
    public function changePassword(ChangePasswordRequest $request)
    {
        //ValidationはChangePasswordRequestで処理
        //パスワード変更処理
        $user = Auth::user();
        $user->password = bcrypt($request->get('password')); // パスワードをハッシュする。
        
        $user->save();

        // パスワード変更処理後、homeにリダイレクト
        return redirect()->route('home')->with('status', __('Your password has been changed.'));
    }

    
}