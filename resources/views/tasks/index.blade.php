@extends('layouts.app')

@section('content')

    {{-- 注意事項 --}}
    <div class="flex items-center justify-center mt-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
        </svg>
        <div class="ml-4 text-center">
            『買うモノ登録ページ』から商品を登録してみましょう！<br>依頼したことのない商品は登録しないと依頼できません
        </div>
    </div>
    
    {{-- 買うモノ登録ページへの遷移ボタン --}}
    <div class="flex items-center justify-center mt-4">
        <a class="btn btn-outline normal-case btn-block btn-red w-1/2" href="{{ route('products.index', Auth::user()->id) }}">買うモノ登録ページへ</a>
    </div>

    {{-- 表題 --}}
    <div class="flex items-center justify-center mt-8">
        <div class="text-xl font-bold">
            依頼内容
        </div>
    </div>
    
    {{-- 依頼内容作成フォーム --}}
    <div class="flex justify-center">
        <form method="POST" action="{{ route('tasks.store') }}" class="w-1/2">
            @csrf

                <div class="form-control my-4">
                    <label for="product_id" class="label">
                        <span class="label-text">商品名：</span>
                    </label>
                    <select name="product_id">
                        <option value="" selected disabled></option>
                        @foreach ($products_options as $products_options)
                            <option value="{{ $products_options->id }}">{{ $products_options->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-control my-4">
                    <label for="quantity" class="label">
                        <span class="label-text">個数：</span>
                    </label>
                    <input type="text" name="quantity" class="input input-bordered w-full">
                </div>
                
                <div class="form-control my-4">
                    <label for="to_user_id" class="label">
                        <span class="label-text">誰に：</span>
                    </label>
                    <select name="to_user_id">
                        <option value="" selected disabled></option>
                        @foreach ($users_options as $users_options)
                            <option value="{{ $users_options->id }}">{{ $users_options->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-control my-4">
                    <label for="note" class="label">
                        <span class="label-text">備考：</span>
                    </label>
                    <input type="text" name="note" class="input input-bordered w-full">
                </div>

            <button type="submit" class="btn btn-outline normal-case btn-block btn-red">この内容で依頼する！</button>
        </form>
    </div>
    {{-- 表題 --}}
    <div class="flex items-center justify-center mt-8">
        <div class="text-xl font-bold">
            依頼タスク一覧
        </div>
    </div>
    @include('tasks.task')
@endsection