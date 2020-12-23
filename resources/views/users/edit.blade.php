@extends('layouts.app')

@section('content')

<div class="index-content">
    <div class="books-list">
        <div class="books-list__title mypage-color">
            ユーザー情報編集
        </div>

        @if (isset($msg))
        <div class="books-list__msg">
            <span>{{$msg}}</span>
        </div>
        @endif

        <div class="book-new">

            <form action="/users/edit" method="post">


                {{ csrf_field() }}

                <div class="form-contents">
                    <div class="form-one-size">
                        <div class="form-input">
                            <div class="form-label">ユーザー名</div>
                            <div><input class="form-input__input" type="text" name="name" value="{{$user->name}}"></div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <input name="id" type="hidden" value="{{$id}}">
                    <input class="btn btn-primary" type="submit" value="変更する">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                </div>

            </form>
        </div>
    </div>
</div>

@endsection