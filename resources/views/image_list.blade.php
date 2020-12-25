<!-- アップロードした画像の一覧 -->
<!-- http://127.0.0.1:8000/list -->

@extends('layouts.app')

@section('content')
<a href="{{ route('upload_form') }}">Upload</a>
<hr />

@foreach($images as $image)
<div style="width: 18rem; float:left; margin: 16px;">
    <img src="{{ Storage::url($image->file_path) }}" style="width:25%;" />
    <p>{{ $image->file_name }}</p>
</div>
@endforeach

@endsection