<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;    // 追加
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    // 「商品一覧表示処理」
    public function index()
    {
        // 認証済みの場合
        if (\Auth::check()) {
            // 認証済みユーザを取得
            $user = \Auth::user();
            // 認証済みユーザの"group_id"に紐づく商品だけを取得(1ページ5件)
            $products = Product::where('group_id', $user->group_id)->orderBy('id', 'desc')->paginate(5);
        }
        
        // 商品一覧ビューでそれを表示
        return view('products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    // 「商品追加処理」
    public function store(Request $request)
    {
        // "products"テーブルへレコード追加の際、商品名の重複排除
        $request->validate([
            'products_name' => 'required|max:255|unique:products,name',
        ]);
        
        // 認証済みの場合
        if (\Auth::check()) {
            // 認証済みユーザを取得
            $user = \Auth::user();
            // 認証済みユーザの"group_id"とフォームから追加した
            // 商品"name"で"products"テーブルにレコード追加
            Product::create([
                'group_id' => $user->group_id,
                'products_name' => $request->name,
            ]);
        }

        // 買うモノ登録ページへリダイレクトさせる
        return redirect('/products');
    }
}
