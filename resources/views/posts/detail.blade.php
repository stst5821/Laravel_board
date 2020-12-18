@extends('layouts.app')
@section('title', 'detail page')

@section('content')
<div class="container">
  <div class="row">
    <!-- メイン -->
    <div class="col-10 col-md-6 offset-1 offset-md-3">
      <div class="card">
        <div class="card-header">
          {{ $post->id }}
        </div>
        <div class="card-body">
          <p class="card-text">{{ $post->body }}</p>

          <div class="card-footer bg-transparent"><span class="font-weight-bold">by:</span>
            <a href="{{ route('users.show', $post->user_id)}}">{{ $user->name }}</a>

          </div>
          <!-- ログイン中だけ表示する -->
          @auth
          <!-- 現在ログイン中のユーザーのみ、編集するボタンが表示されるようにした。 -->
          @if (Auth::user()->id == $post->user_id)
          <a href="{{ url('posts/edit/'.$post->id) }}" class="btn btn-dark">編集する</a>
          @endif

          @endauth
        </div>
      </div>
    </div>
  </div>
</div>
@endsection