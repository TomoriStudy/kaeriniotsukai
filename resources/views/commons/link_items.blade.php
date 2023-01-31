@if (Auth::check())
    {{-- ユーザ一覧ページへのリンク --}}
    <li><a class="link link-hover text-black" href="#">Users</a></li>
    {{-- ユーザ詳細ページへのリンク --}}
    <li><a class="link link-hover text-black" href="#">{{ Auth::user()->name }}&#39;s profile</a></li>
    <li class="divider lg:hidden"></li>
    {{-- ログアウトへのリンク --}}
    <li><a class="link link-hover text-black" href="#" onclick="event.preventDefault();this.closest('form').submit();">Logout</a></li>
@else
    {{-- ユーザ登録ページへのリンク --}}
    <li><a class="link link-hover text-black" href="{{ route('register') }}">会員登録</a></li>
    <li class="divider lg:hidden"></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover text-black" href="{{ route('login') }}">ログイン</a></li>
@endif