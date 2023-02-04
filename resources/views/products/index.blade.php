@extends('layouts.app')

@section('content')

    {{-- 商品追加フォーム --}}
    @include('products.form')
    <div class="flex items-center justify-center mt-8">
        <div class="text-xl font-bold">
            登録内容
        </div>
    </div>

    @if (isset($products))
        <div class="flex justify-center">
            <table class="table table-zebra w-1/2 mt-4">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>商品名</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td class="truncate" style="max-width: 100px" title="{{ $product->id }}">{{ $product->id }}</td>
                        <td class="truncate" style="max-width: 100px" title="{{ $product->name }}">{{ $product->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- ページネーションのリンク --}}
        <div class="pagination flex justify-center mt-4">
            {{ $products->links() }}
        </div>
    @endif

@endsection