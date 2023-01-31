@if (Auth::check())
    {{-- マイページへのリンク --}}
    <li><a class="link link-hover text-black" href="{{ route('users.show', Auth::user()->id) }}">マイページ</a></li>
    {{-- 買うモノ登録ページへのリンク --}}
    <li><a class="link link-hover text-black" href="#">買うモノ登録ページ</a></li>
    {{-- おつかい依頼ページへのリンク --}}
    <li><a class="link link-hover text-black" href="#">おつかい依頼ページ</a></li>
    {{-- ログアウトへのリンク --}}
    <li><a class="link link-hover text-black" href="#" onclick="event.preventDefault();this.closest('form').submit();">Logout</a></li>
@else
    {{-- ユーザ登録ページへのリンク --}}
    <li><a class="link link-hover text-black" href="{{ route('register') }}">会員登録</a></li>
    <li class="divider lg:hidden"></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover text-black" href="{{ route('login') }}">ログイン</a></li>
@endif