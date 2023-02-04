@if (Auth::check())
    {{-- マイページへのリンク --}}
    <li><a class="link link-hover text-gray" href="{{ route('users.show', Auth::user()->id) }}">マイページ</a></li>
    {{-- 買うモノ登録ページへのリンク --}}
    <li><a class="link link-hover text-gray" href="{{ route('products.index', Auth::user()->id) }}">買うモノ登録ページ</a></li>
    {{-- おつかい依頼ページへのリンク --}}
    <li><a class="link link-hover text-gray" href="{{ route('tasks.index', Auth::user()->id) }}">おつかい依頼ページ</a></li>
    {{-- ログアウトへのリンク --}}
    <li><a class="link link-hover text-gray" href="#" onclick="event.preventDefault();this.closest('form').submit();">ログアウト</a></li>
@else
    {{-- ユーザ登録ページへのリンク --}}
    <li><a class="link link-hover text-gray" href="{{ route('register') }}">会員登録</a></li>
    <li class="divider lg:hidden"></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover text-gray" href="{{ route('login') }}">ログイン</a></li>
@endif