@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Deactive') }}</div>

                <div class="card-body text-center">
                    <form method="POST" action="{{ route('deactive') }}">
                        @csrf
                        <h2>{{ __('アカウントを削除します。') }}</h2>
                        <p>{{ __('よろしければ、以下のボタンを押してください。') }}</p>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Deactive') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection