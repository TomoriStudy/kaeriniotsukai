<div class="mt-4">
    @if (isset($requested_tasks))
        <ul class="list-none">
            @foreach ($requested_tasks as $requested_task)
                <li class="flex items-start gap-x-2 mb-4 text-sm">
                    {{-- タスクを依頼したユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                    {{-- なのだが、現在はマイページを開いたユーザのメールアドレスになっていると思う --}}
                    <div class="avatar">
                        <div class="w-12 rounded">
                            <img src="{{ Gravatar::get($user->email) }}" alt="" />
                        </div>
                    </div>
                    <div>
                        {{-- 依頼された内容 --}}
                        <!--<p class="mb-0 truncate text-rose-500 ml-1" style="display: inline-block; max-width: 100px">{!! nl2br(e($requested_task->id)) !!}.</p>-->
                        <!--<p class="mb-0 truncate" style="display: inline-block; max-width: 100px">{!! nl2br(e($requested_task->name)) !!}</p>-->
                        <p class="mb-0 truncate ml-1 task-content" style="display: inline-block;">{!! nl2br(e($requested_task->created_at)) !!}</p>
                        <p class="mb-0" style="display: inline-block;">に</p>
                        <p class="mb-0 truncate task-content" style="display: inline-block; max-width: 100px">{!! nl2br(e(App\Models\User::find($requested_task->from_user_id)->name)) !!}</p>
                        <p class="mb-0" style="display: inline-block;">から</p>
                        <p class="mb-0 truncate task-content" style="display: inline-block; max-width: 100px">{!! nl2br(e(App\Models\Product::find($requested_task->product_id)->name)) !!}</p>
                        <p class="mb-0" style="display: inline-block;">を</p>
                        <p class="mb-0 truncate task-content" style="display: inline-block; max-width: 100px">{!! nl2br(e($requested_task->quantity)) !!}</p>
                        <p class="mb-0" style="display: inline-block;">個</p>
                        <br>
                        <p class="mb-0 ml-1" style="display: inline-block;">備考：</p>
                        <p class="mb-0 truncate ml-2 task-content" style="display: inline-block; max-width: 400px">{!! nl2br(e($requested_task->note)) !!}</p>
                    </div>
                </li>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $request_tasks->links() }}
    @endif
</div>