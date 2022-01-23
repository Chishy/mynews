@extends('layouts.edit')
@section('title', 'プロフィールの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール編集</h2>
                <form action="{{ action('Admin\ProfileController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="simei">氏名(name)</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="simei" value="{{ $profiles_form->simei }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="simei">性別(gender)</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="seibetsu" value="{{ $profiles_form->seibetsu }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="simei">趣味(hobby)</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="syumi" value="{{ $profiles_form->syumi }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">自己紹介欄</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="syoukai" rows="10">{{ $profiles_form->syoukai }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="image">プロフィール写真</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中:{{ $profiles_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $profiles_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($profiles_form->profilehistories!= NULL)
                            @foreach ($profiles_form->profilehistories as $profilehistories)
                            <li class="list-group-item">{{ $profilehistories->edited_at }}</li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection