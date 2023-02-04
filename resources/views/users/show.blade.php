@extends('layouts.app')

@section('content')
       {{-- 画面2分割 --}}
        <div class="sm:grid sm:grid-cols-2 sm:gap-8">
            <div class="ml-4">
                {{-- アイコン(左上) --}}
                <aside class="mb-4">
                    {{-- ユーザ情報 --}}
                    @include('users.card')
                </aside>
                {{-- 依頼したタスク一覧(左下) --}}
                <div>
                    <div style="border: 1px solid gray; padding: 5px; height: 50px; background-color: #ad7d85; display: flex; align-items: center; justify-content: center; color: #fff;">
                        依頼したタスク一覧
                    </div>
                    <div>
                        {{-- (依頼した)タスク一覧・内容 --}}
                        @include('tasks.requesttask')
                    </div>
                </div>
            </div>
            <div class="mr-4">
                {{-- タスク一覧(右上) --}}
                <div class="flex items-center justify-center mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <div class="ml-4 text-center">
                        おつかいを依頼してみましょう！
                    </div>
                </div>
                <div class="mt-4">
                    {{-- おつかい依頼ページへの遷移ボタン --}}
                    <a class="btn btn-outline normal-case btn-block btn-red mb-4" href="{{ route('tasks.index', Auth::user()->id) }}">おつかい依頼ページへ</a>
                </div>
                {{-- おつかい依頼欄(右下) --}}
                <div style="border: 1px solid gray; padding: 5px; height: 50px; background-color: #ad7d85; display: flex; align-items: center; justify-content: center; color: #fff;">
                    依頼されたタスク一覧
                </div>
                <div>
                    {{-- (依頼された)タスク一覧・内容 --}}
                    @include('tasks.requestedtask')
                </div>
            </div>
        </div>
@endsection