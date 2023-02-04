@extends('layouts.app')

@section('content')

    <div class="flex items-center justify-center mt-8">
        <div class="text-xl font-bold">
            会員登録
        </div>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('register') }}" class="w-1/2">
            @csrf

            <div class="form-control my-4">
                <label for="name" class="label">
                    <span class="label-text">お名前：</span>
                </label>
                <input type="text" name="name" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="email" class="label">
                    <span class="label-text">メールアドレス：</span>
                </label>
                <input type="email" name="email" class="input input-bordered w-full">
            </div>

            <div class="form-group">
                <label for="group_id" class="label">
                    <span class="label-text">家族グループID：</span>
                </label>
                <div class="form-check form-check-inline">
                    <input type="radio" name="family_check" class="form-check-input" id="family_check01" value="1" checked>
                    <label for="family_check01" class="form-check-label">既存の家族グループに参加する</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="family_check" class="form-check-input" id="family_check02" value="2" >
                    <label for="family_check02" class="form-check-label">新規の家族グループを作成する</label>
                </div>
                <br>
                    <input type="text" name="group_id" class="input input-bordered w-full">
                </label>
            </div>

            <div class="form-control my-4">
                <label for="password" class="label">
                    <span class="label-text">パスワード：</span>
                </label>
                <input type="password" name="password" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="password_confirmation" class="label">
                    <span class="label-text">パスワード確認：</span>
                </label>
                <input type="password" name="password_confirmation" class="input input-bordered w-full">
            </div>

            <button type="submit" class="btn btn-outline normal-case btn-block btn-red mt-4">会員登録</button>
        </form>
    </div>
@endsection