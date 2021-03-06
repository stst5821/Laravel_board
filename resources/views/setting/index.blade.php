@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('マイページ') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if (!$auth->email_verified_at)
                    <div class="alert alert-warning" role="alert">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email,') }}
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another.') }}</button>
                        </form>
                    </div>
                    @endif

                    <div class="list-group mb-3" style="max-width:400px; margin:auto;">

                        <!-- 名前 -->

                        <!-- メールアドレス認証が終わったら -->
                        <a href="{{ route('name.form') }}" @if ($auth->email_verified_at)
                            class="list-group-item list-group-item-action d-flex justify-content-between
                            align-items-center"
                            @else
                            class="list-group-item list-group-item-action d-flex justify-content-between
                            align-items-center disabled" tabindex="-1" aria-disabled="true"
                            @endif
                            >
                            <dl class="mb-0">
                                <dt>{{ __('名前') }}</dt>
                                <dd class="mb-0">{{ $auth->name }}</dd>
                            </dl>
                            @if ($auth->email_verified_at)
                            <div><i class="fas fa-chevron-right"></i></div>
                            @endif
                        </a>

                        <!-- アイコン画像 -->


                        <a href="{{ route('image_form') }}" @if ($auth->email_verified_at)
                            class="list-group-item list-group-item-action d-flex justify-content-between
                            align-items-center"
                            @else
                            class="list-group-item list-group-item-action d-flex justify-content-between
                            align-items-center disabled" tabindex="-1" aria-disabled="true"
                            @endif
                            >
                            <dl class="mb-0">
                                <dt>{{ __('アイコン') }}</dt>
                                <dd class="mb-0"> <img src="{{ Storage::url($uploads->file_path) }}"
                                        style="width:10%;" />
                                </dd>
                            </dl>
                            @if ($auth->email_verified_at)
                            <div><i class="fas fa-chevron-right"></i></div>
                            @endif
                        </a>

                        <!-- メールアドレス -->

                        <a href="{{ route('email.form') }}" class="list-group-item list-group-item-action d-flex justify-content-between
                            align-items-center">
                            <dl class="mb-0">
                                <dt>{{ __('メールアドレス') }}</dt>
                                <dd class="mb-0">{{ $auth->email }}</dd>
                            </dl>
                            <div><i class="fas fa-chevron-right"></i></div>
                        </a>

                        <!-- パスワード -->

                        <a href="{{ route('password.form') }}" @if ($auth->email_verified_at)
                            class="list-group-item list-group-item-action d-flex justify-content-between
                            align-items-center"
                            @else
                            class="list-group-item list-group-item-action d-flex justify-content-between
                            align-items-center disabled" tabindex="-1" aria-disabled="true"
                            @endif
                            >
                            <dl class="mb-0">
                                <dt>{{ __('パスワード') }}</dt>
                                <dd class="mb-0">********</dd>
                            </dl>
                            @if ($auth->email_verified_at)
                            <div><i class="fas fa-chevron-right"></i></div>
                            @endif
                        </a>

                    </div>

                    <!-- アカウント削除 -->

                    <div class="list-group" style="max-width:400px; margin:auto;">

                        <!-- ↓削除フォームをまだ作ってないので、リンク先は#にしておく。 -->
                        <a href="{{ route('deactive.form') }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>{{ __('アカウント削除') }}</div>
                            <div><i class="fas fa-chevron-right"></i></div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection