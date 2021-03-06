<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\UploadImage;
use App\User;
use Illuminate\Support\Facades\Auth;


class UploadImageController extends Controller
{
    function show() {
		return view("upload_form");
	}

	function upload(Request $request){
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