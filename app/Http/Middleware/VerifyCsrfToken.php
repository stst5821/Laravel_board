<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [

        // ここにcsrfバリデーションから除外するURIを書く。
        // 例えば、stripeという支払いサイトはcsrfを知らないので、送ってもわからないため除外しないといけない。

        // 'stripe/*',
        // 'http://example.com/foo/bar',
        // 'http://example.com/foo/*',
        
    ];
}