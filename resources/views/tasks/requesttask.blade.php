<div class="mt-4">
    @if (isset($request_tasks))
        <ul class="list-none">
            @foreach ($request_tasks as $request_task)
                <li class="flex items-start gap-x-2 text-sm">
                    {{-- タスクを依頼したユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                    {{-- アイコンと依頼内容のひとかたまり・二つの要素を横並びで表示 --}}
                    <div class="flex flex-row-reverse">
                        <div class="flex items-start gap-x-2 ml-2">
                            <div class="avatar">
                                <div class="w-12 rounded">
                                    <img src="{{ Gravatar::get($user->email) }}" alt="" />
                                </div>
                            </div>
                            <div>
                                {{-- 依頼した内容 --}}
                                {{-- IDは表示させないこととする --}}
                                <!--<p class="mb-0 truncate text-rose-500 ml-1" style="display: inline-block;">{!! nl2br(e($request_task->id)) !!}.</p>-->
                                <!--<p class="mb-0 truncate" style="display: inline-block; max-width: 100px">{!! nl2br(e($request_task->name)) !!}</p>-->
                                <p class="mb-0 truncate ml-1 task-content" style="display: inline-block;">{!! nl2br(e($request_task->created_at)) !!}</p>
                                <p class="mb-0" style="display: inline-block;">に</p>
                                <p class="mb-0 truncate task-content" style="display: inline-block; max-width: 100px">{!! nl2br(e(App\Models\User::find($request_task->to_user_id)->name)) !!}</p>
                                <p class="mb-0" style="display: inline-block;">に</p>
                                <p class="mb-0 truncate task-content" style="display: inline-block; max-width: 100px">{!! nl2br(e(App\Models\Product::find($request_task->product_id)->name)) !!}</p>
                                <p class="mb-0" style="display: inline-block;">を</p>
                                <p class="mb-0 truncate task-content" style="display: inline-block; max-width: 100px">{!! nl2br(e($request_task->quantity)) !!}</p>
                                <p class="mb-0" style="display: inline-block;">個</p>
                                <br>
                                <p class="mb-0 ml-1" style="display: inline-block;">備考：</p>
                                <p class="mb-0 truncate ml-2 task-content" style="display: inline-block; max-width: 250px">{!! nl2br(e($request_task->note)) !!}</p>
                            </div>
                        </div>
                        {{-- 二つのボタンひとかたまりにして横並びで表示 --}}
                        <div class="flex items-start gap-2 m-2">
                            <div class="bd-highlight">
                                {{-- 依頼したタスク編集ページへのリンク --}}
                                <a class="btn btn-success btn-sm normal-case" href="{{ route('tasks.edit', $request_task->id) }}">編集</a>
                            </div>
                            <div class="bd-highlight">
                                @if (Auth::id() == $request_task->from_user_id)
                                    {{-- 依頼したタスク削除ボタンのフォーム --}}
                                    <form method="POST" action="{{ route('tasks.destroy', $request_task->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error btn-sm normal-case" 
                                            onclick="return confirm('Delete id = {{ $request_task->id }} ?')">削除</button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-dark btn-sm normal-case" disabled>削除</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $request_tasks->links() }}
    @endif
</div>