<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    
    // おつかい依頼ページ表示処理
    public function index()
    {
        // 認証済みの場合
        if (\Auth::check()) {
            // 認証済みユーザを取得
            $user = \Auth::user();
            // 認証済みユーザが依頼したタスクだけを取得(1ページ5件)
            $tasks = Task::where('from_user_id', $user->id)->orderBy('id', 'desc')->paginate(5);
            
            // データベースから、「商品」プルダウンに表示するレコードコレクションを取得
            // ただし、自分と同じ"group_id"のレコードだけを取得
            // プルダウン用の変数
            $products_options = Product::where('group_id', $user->group_id)->get();
            
            // データベースから、「依頼されたユーザ」プルダウンに表示するレコードコレクションを取得
            // ただし、自分と同じ"group_id"のレコードだけを取得
            // プルダウン用の変数
            $users_options = User::where('group_id', $user->group_id)->get();
        }
        
        // 依頼したタスク一覧ビューでそれを表示
        return view('tasks.index', [
            'tasks' => $tasks,
            'products_options' => $products_options,
            'users_options' => $users_options,
        ]);
    }
    
    // おつかい依頼ページでの新規タスク登録処理
    public function store(Request $request)
    {
        // フォームからの入力値バリデーション
        $request->validate([
            'to_user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer',
            'note' => 'max:255',
        ]);
        
        // 認証済みの場合
        if (\Auth::check()) {
            // 認証済みユーザを取得
            $user = \Auth::user();
            
            // 依頼内容で入力した内容でデータベース作成
            $task = Task::create([
                'from_user_id' => $user->id,
                'to_user_id' => $request->to_user_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'note' => $request->note,
            ]);
        }

        // おつかい依頼ページへリダイレクトさせる
        return redirect('/tasks');
    }
    
    // マイページでの依頼したタスク編集画面表示処理
    public function edit($id)
    {
        // 認証済みの場合
        if (\Auth::check()) {
            // 認証済みユーザを取得
            $user = \Auth::user();
            
            // データベースから、「商品」プルダウンに表示するレコードコレクションを取得
            // ただし、自分と同じ"group_id"のレコードだけを取得
            // プルダウン用の変数
            $products_options = Product::where('group_id', $user->group_id)->get();
            
            // データベースから、「依頼されたユーザ」プルダウンに表示するレコードコレクションを取得
            // ただし、自分と同じ"group_id"のレコードだけを取得
            // プルダウン用の変数
            $users_options = User::where('group_id', $user->group_id)->get();
        }
        
        // idの値で依頼したタスクを検索して取得
        $request_task = Task::findOrFail($id);

        // 依頼したタスク編集ビューでそれを表示
        if (\Auth::id() === $request_task->from_user_id) {
            return view('tasks.edit', [
                'request_task' => $request_task,
                'products_options' => $products_options,
                'users_options' => $users_options,
            ]);
        }
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }
    
    // 依頼したタスク編集内容更新処理
    public function update(Request $request_task, $id)
    {
        // バリデーション
        $request_task->validate([
            'quantity' => 'required|integer',
            'note' => 'max:255',
        ]);
        
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        
        // 認証済みの場合
        if (\Auth::check()) {
            // 認証済みユーザを取得
            $user = \Auth::user();
            // メッセージを更新
            if (\Auth::id() === $task->from_user_id) {
                $task->to_user_id = $request_task->to_user_id;
                $task->product_id = $request_task->product_id;
                $task->quantity = $request_task->quantity;
                $task->note = $request_task->note;
                $task->save();
                // マイページへリダイレクトさせる
                return redirect('/users/{id}');
            }
        }

        // トップページへリダイレクトさせる
        return redirect('/');
    }
    
    // 依頼したタスク削除処理
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $request_task = \App\Models\Task::findOrFail($id);
        
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は投稿を削除
        if (\Auth::id() === $request_task->from_user_id) {
            $request_task->delete();
            return back()
                ->with('success','Delete Successful');
        }

        // 前のURLへリダイレクトさせる
        return back()
            ->with('Delete Failed');
    }
}
