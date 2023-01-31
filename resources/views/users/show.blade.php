@extends('layouts.app')

@section('content')
        {{-- 画面2分割 --}}
        <div class="sm:grid sm:grid-cols-2 sm:gap-8">
            {{-- アイコン(左上) --}}
            <aside class="mx-8">
                {{-- ユーザ情報 --}}
                @include('users.card')
            </aside>
            {{-- タスク一覧(右上) --}}
            <div>
                {{-- (依頼された)タスク一覧・表題 --}}
                依頼されたタスク一覧
                {{-- (依頼された)タスク一覧・内容 --}}
                @include('users.card')
            </div>
        </div>
        <div class="sm:grid sm:grid-cols-2 sm:gap-8">
            {{-- 依頼したタスク一覧(左下) --}}
            <div>
                {{-- (依頼した)タスク一覧・表題 --}}
                依頼したタスク一覧
                {{-- (依頼した)タスク一覧・内容 --}}
                @include('users.card')
            </div>
            {{-- おつかい依頼欄(右下) --}}
            <div>
                {{-- おつかい依頼・表題 --}}
                おつかいを依頼しよう！
                {{-- おつかい依頼ページへの遷移ボタン --}}
                <a class="btn btn-lg normal-case bg-stone-500 btn-block" href="#">おつかい依頼ページへ</a>
            </div>
        </div>
@endsection