@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('画像変更') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('image_change') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('現在の画像') }}</label>
                            <div class="col-md-6">
                                <img src="{{ Storage::url($uploads->file_path) }}" style="width:15%;" />

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('新しい画像') }}</label>
                            <div class="col-md-6">
                                <input type="file" name="image" accept="image/png, image/jpeg">
                                <!-- ↑acceptで、アップロードできるファイルを画像に限定している。 -->
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('変更') }}
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