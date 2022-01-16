@extends('user.layout')
@section('title', '新規登録')
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h2 class="text-secondary">新規登録フォーム</h2>
        
        <form action="{{ route('signup') }}" method="post"  style="margin-top: 50px;" onsubmit="return checkSubmit()">
        @csrf
            <div class="form-group text-secondary">
                <label for="user_name">ユーザー名</label>
                    <input type="text" name="user_name" class="form-control" id="user_name">
                @if ($errors->has('user_name'))
                <div class="text-danger">
                    {{ $errors->first('user_name') }}
                </div>
                @endif
            </div>

            <div class="form-group text-secondary">
                <label  for="email">メールアドレス</label>
                    <input type="email" name="email" class="form-control" id="email">
                @if ($errors->has('email'))
                <div class="text-danger">
                    {{ $errors->first('email') }}
                </div>
                @endif
            </div>

            <div class="form-group text-secondary">
                <label for="password">パスワード</label>
                    <input type="password" name="password" class="form-control" id="password">
                @if ($errors->has('password'))
                <div class="text-danger">
                    {{ $errors->first('password') }}
                </div>
                @endif
            </div>

            <div class="form-group text-secondary">
                <label for="password_confirmation">確認用パスワード</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                @if ($errors->has('password_confirmation'))
                <div class="text-danger">
                    {{ $errors->first('password_confirmation') }}
                </div>
                @endif
            </div>

            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('login') }}">戻る</a>
                <button type="submit" class="btn btn-primary">新規登録</button>
            </div>
        </form>
    </div>
</div>
@endsection