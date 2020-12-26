<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UploadImage;
use App\User;

use App\Http\Requests\ChangeNameRequest; // Http/Requests/ChangeNameRequest.phpを使うための宣言
use App\Http\Requests\ChangeEmailRequest;


class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // ユーザー情報一覧========================================================================================================

    
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


    // 名前変更========================================================================================================


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


    // メールアドレス変更========================================================================================================


    public function showChangeEmailForm()
    {
        $auth = Auth::user();
        return view('setting.email', ['auth' => $auth]);
    }
    
    public function changeEmail(ChangeEmailRequest $request)
    {
        //ValidationはChangeUsernameRequestで処理
        //メールアドレス変更処理
        $user = Auth::user();
        $user->email = $request->get('email');
        $user->save();

        //homeにリダイレクト
        return redirect()->route('setting')->with('status', __('Your email address has been changed.'));
    }


    // 画像変更========================================================================================================


    function imageChangeForm() {
        
        $auth = Auth::user();
        $user = User::find(Auth::user()->id); // 現在ログインしているユーザーのIDを使って、userテーブルからレコードを持ってくる。
        $uploads = UploadImage::find($user->image_id); // $userのimage_idカラムのデータを使って、uploadimageからレコードを持ってくる。

        return view('setting.image',['uploads' => $uploads]);        
	}

	function changeImage(Request $request){
		$request->validate([
			'image' => 'required|file|image|mimes:png,jpeg'
			// 必須|アップロード形式|||
		]);
		// ↓viewから渡される値を受け取る
		$upload_image = $request->file('image');
		
		if($upload_image) {
			
			//アップロードされた画像を保存する。publicストレージのuploadsディレクトリに保存する。
			$path = $upload_image->store('uploads',"public");

			//画像の保存に成功したらDBに記録する
			if($path){
				UploadImage::create([
					"file_name" => $upload_image->getClientOriginalName(),
					"file_path" => $path
				]);
			}
		}
		// ↑でDBに記録したレコードのIDを取りたいので、直前に登録されたレコードを取得するため、orderbyでcreated_atを新しい順に並べて、一番最初のレコードを取得している。
		$image = UploadImage::orderBy('created_at', 'desc')->first();
        $user = User::find(Auth::user()->id); // 現在ログインしているユーザーのIDを使って、userテーブルからレコードを持ってくる。
		
		$user->image_id = $image->id; // userテーブルのimage_idに、upload_imageテーブルのidを代入。
		$user->save();
		
		return redirect("setting");
	}
}