<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
use App\Models\Product;

class UsersController extends Controller
{
    public function show()
    {
        // 認証済みの場合
        if (\Auth::check()) {
            // 認証済みユーザを取得
            $user = \Auth::user();
            // 認証済みユーザが依頼したタスクだけを取得(1ページ4件)
            $request_tasks = Task::where('from_user_id', $user->id)->orderBy('id', 'desc')->paginate(4);
            // 認証済みユーザが依頼されたタスクだけを取得(1ページ8件)
            $requested_tasks = Task::where('to_user_id', $user->id)->orderBy('id', 'desc')->paginate(8);
        }

        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'request_tasks' => $request_tasks,
            'requested_tasks' => $requested_tasks,
        ]);
    }
}
