@extends('layouts.app')

@section('content')

<div class="container mt-4">

  <div class="mb-4">
    <p>{{ $user_name }}の投稿一覧</p>
  </div>

  @foreach ($posts as $post)
  <div class="card mb-4">

    <div class="card-body">
      <p class="card-text">
        <li> {{ \Illuminate\Support\Str::limit($post->body, 140) }}
      </p>
      <a class="card-link" href="{{ route('posts.show', ['post' => $post]) }}">
        続きを読む
      </a>

    </div>
    <div class="card-footer">
      <span class="mr-2">
        投稿日時 {{ $post->created_at->format('Y.m.d') }}
      </span>

    </div>
  </div>
  @endforeach

  {{-- ページネーション --}}
  <div class="d-flex justify-content-center mb-5">
    {{ $posts->links() }}
  </div>

</div>
@endsection