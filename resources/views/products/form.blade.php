<div class="mt-4">
    
    <div class="flex items-center justify-center mt-8">
        <div class="text-xl font-bold">
            買うモノ登録
        </div>
    </div>
    
    <div class="flex justify-center">
        <form method="POST" action="{{ route('products.store') }}" class="w-1/4">
            @csrf
        
            <div class="form-control mt-4">
                <input type="text" name="product_name" class="input input-bordered w-full text-center" value="{{ old('name', '-- 登録する商品名を入力してください --') }}" style="color: #808080;">
            </div>
        
            <button type="submit" class="btn btn-outline normal-case btn-block btn-red mt-4">登録する！</button>
        </form>
    </div>
    
</div>