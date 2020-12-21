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

      <form action="{{ route('user_update', $auth->id)}}" method="post" enctype="multipart/form-data">

        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="form-contents">
          <div class="form-one-size">
            <div class="form-input">
              <div class="form-label">ユーザー名</div>
              <div><input class="form-input__input" type="text" name="name" value="{{$auth->name}}"></div>
            </div>
          </div>
        </div>

        <div class="form-foot">
          <input class="send" type="submit" value="編集">
        </div>
      </form>
    </div>
  </div>
</div>

@endsection