@extends('layouts.app')

@section('content')

    {{-- 表題 --}}
    <div class="flex items-center justify-center mt-8">
        <div class="text-xl font-bold">
            No: {{ $request_task->id }} のおつかい編集ページ</h2>
        </div>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('tasks.update', $request_task->id) }}" class="w-1/2">
            @csrf
            @method('PUT')

                <div class="form-control my-4">
                    <label for="product_id" class="label">
                        <span class="label-text">商品名：</span>
                    </label>
                    <select name="product_id">
                        @foreach ($products_options as $products_options)
                            <option value="{{ $products_options->id }}"
                            @if ($products_options->id == $request_task->product_id)
                                selected
                            @endif
                            >{{ $products_options->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-control my-4">
                    <label for="quantity" class="label">
                        <span class="label-text">個数：</span>
                    </label>
                    <input type="text" name="quantity" value="{{ $request_task->quantity }}" class="input input-bordered w-full">
                </div>
                
                <div class="form-control my-4">
                    <label for="to_user_id" class="label">
                        <span class="label-text">誰に：</span>
                    </label>
                    <select name="to_user_id">
                        @foreach ($users_options as $users_options)
                            <option value="{{ $users_options->id }}"
                            @if ($users_options->id == $request_task->to_user_id)
                                selected
                            @endif
                            >{{ $users_options->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-control my-4">
                    <label for="note" class="label">
                        <span class="label-text">備考：</span>
                    </label>
                    <input type="text" name="note" value="{{ $request_task->note }}" class="input input-bordered w-full">
                </div>

            <button type="submit" class="btn btn-outline normal-case btn-block btn-red">この内容で更新する！</button>
        </form>
    </div>
@endsection