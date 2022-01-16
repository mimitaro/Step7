@extends('user.layout')
@section('title', 'ログイン')
@section('content')

@if (session('success_msg'))
    <div class="text-danger">
        {{ session('success_msg') }}
    </div>
@endif
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h2 class="text-secondary">ログインフォーム</h2>

        <form action="{{ route('user') }}" method="post">
            @csrf
            <div class="form-group text-secondary">
                <label for="email">メールアドレス</label>
                <input type="text" id="email" name="email" class="form-control">
                @if ($errors->has('email'))
                <div class="text-danger">
                    {{ $errors->first('email') }}
                </div>
                @endif
            </div>

            <div class="form-group text-secondary">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" class="form-control">
                @if ($errors->has('password'))
                <div class="text-danger">
                    {{ $errors->first('password') }}
                </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">ログイン</button>
            <a class="col-sm-12" href="{{ route('register') }}">新規登録はこちら</a>
        </form>
    </div>
</div>
@endsection