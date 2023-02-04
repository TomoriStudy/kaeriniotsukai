<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>帰りに〇〇買ってきて</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

    <body class="bg-gray-200">

        {{-- ナビゲーションバー --}}
        @include('commons.navbar')

        <div class="container mx-auto">
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')

            @yield('content')
        </div>

    </body>
</html>