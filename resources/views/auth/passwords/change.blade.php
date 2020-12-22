@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div>

                <div class="card-body">

                    <!-- password.changeにデータを飛ばす。 -->
                    <form method="POST" action="{{ route('password.change') }}">

                        <!-- 悪意のあるデータ送信を防いでくれる。http/middleware/VerifyCsrfToken.phpで除外などの設定ができる。 -->
                        @csrf


                        <div class="form-group row">
                            <label for="current_password"
                                class="col-md-4 col-form-label text-md-right">{{ __('現在のパスワード') }}</label>

                            <div class="col-md-6">
                                <input id="current_password" type="password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    name="current_password" required autocomplete="new-password">

                                @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('新しいパスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('新しいパスワード(確認)') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('変更する') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection