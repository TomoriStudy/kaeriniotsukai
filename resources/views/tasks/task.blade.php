@if (isset($tasks))
    <div class="flex justify-center">
        <table class="table table-zebra w-1/2 my-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>依頼をお願いした人</th>
                    <th>依頼をお願いされた人</th>
                    <th>商品名</th>
                    <th>個数</th>
                    <th>備考</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td class="truncate" style="max-width: 100px" title="{{ $task->id }}">{{ $task->id }}</td>
                    <td class="truncate" style="max-width: 100px" title="{{ App\Models\User::find($task->from_user_id)->name }}">{{ App\Models\User::find($task->from_user_id)->name }}</td>
                    <td class="truncate" style="max-width: 100px" title="{{ App\Models\User::find($task->to_user_id)->name }}">{{ App\Models\User::find($task->to_user_id)->name }}</td>
                    <td class="truncate" style="max-width: 100px" title="{{ App\Models\Product::find($task->product_id)->name }}">{{ App\Models\Product::find($task->product_id)->name }}</td>
                    <td class="truncate" style="max-width: 100px" title="{{ $task->quantity }}">{{ $task->quantity }}</td>
                    <td class="truncate" style="max-width: 100px" title="{{ $task->note }}">{{ $task->note }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{-- ページネーションのリンク --}}
    <div class="pagination">
            {{ $tasks->links() }}
    </div>
@endif