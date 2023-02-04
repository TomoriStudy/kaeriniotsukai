@extends('layouts.app')

@section('content')

    <div class="flex items-center justify-center mt-8">
        <div class="text-xl font-bold">
            ログイン
        </div>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('login') }}" class="w-1/2">
            @csrf

            <div class="form-control my-4">
                <label for="email" class="label">
                    <span class="label-text">メールアドレス：</span>
                </label>
                <input type="email" name="email" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="password" class="label">
                    <span class="label-text">パスワード：</span>
                </label>
                <input type="password" name="password" class="input input-bordered w-full">
            </div>

            <button type="submit" class="btn btn-outline normal-case btn-block btn-red mt-4">ログイン</button>
        </font>

        {{-- ユーザ登録ページへのリンク --}}
        <p class="mt-2">新しいユーザですか？ <a class="link link-hover link-user" href="{{ route('register') }}">会員登録ページへ</a></p>
    </div>
@endsection