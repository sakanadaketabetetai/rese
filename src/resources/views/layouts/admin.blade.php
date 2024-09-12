<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理画面</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="flex">
        <!-- サイトメニュー -->
        <nav class="w-1/5 bg-gray-800 min-h-screen p-4">
            <div class="text-white text-lg font-semibold">
                管理メニュー
            </div>
            <ul class="mt-4">
                @role('admin')
                <li class="mt-2" >
                    <a href="{{ route('admin.users.index') }}">ユーザー一覧</a>
                </li>
                <li class="mt-2" >
                    <a href="{{ route('admin.stores.index') }}">店舗情報一覧</a>
                </li>
                <li class="mt-2" >
                    <a href="{{ route('admin.store.owners') }}">店舗代表者入力画面</a>
                </li>
                <li class="mt-2" >
                    <a href="/back">home</a>
                </li>
                @endrole
            </ul>
        </nav>
        <div class="w-4/5 p-8">
            @yield('content')
        </div>
    </div>
</body>
</html>
