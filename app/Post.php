<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts'; // DBのテーブルを指定してmodelから操作できるようにする。

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}