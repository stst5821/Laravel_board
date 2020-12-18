<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UploadImage extends Model
{
    // use HasFactory;
	// ↓使うテーブルを指定している。
	protected $table = "upload_image";
	protected $fillable = ["file_name","file_path"];
}