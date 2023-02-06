<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        // $request->validate([
        //     'name' => 'required|max:255|unique:family_groups,name'
        // ]);
        
        
        // 認証済みの場合
        if (\Auth::check()) {
            
            // 認証済みユーザを取得
            $user = \Auth::user();
            
            // 商品登録の際に、DBに既に登録がある場合バリデーションエラー
            // ※同じグループIDを持つ場合のみ
            $request->validate([
                'product_name' => ['required', Rule::unique('products', 'name')->where(function ($query) use ($request) {
                    $query->where('group_id', \Auth::user()->group_id);
                    // SQL文の発行とその確認
                    // $sql = $query->toSql();
                    // dd($sql);
                })],
            ]);

            // DBにレコード作成
            Product::create([
                'group_id' => $user->group_id,
                'name' => $request->product_name,
            ]);
        }

        // 買うモノ登録ページへリダイレクトさせる
        return redirect('/products');
    }
}
