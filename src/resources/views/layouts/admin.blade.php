<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理画面</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body>
    <div class="admin-dashboard">
        <!-- サイトメニュー -->
        <nav class="admin-dashboard__sidebar">
            <div class="admin-dashboard__menu-title">
                管理メニュー
            </div>
            <ul class="admin-dashboard__menu-list">
                @role('admin')
                <li class="admin-dashboard__menu-item">
                    <a href="{{ route('admin.users.index') }}" class="admin-dashboard__menu-link">ユーザー一覧</a>
                </li>
                <li class="admin-dashboard__menu-item">
                    <a href="{{ route('admin.stores.index') }}" class="admin-dashboard__menu-link">店舗情報一覧</a>
                </li>
                <li class="admin-dashboard__menu-item">
                    <a href="{{ route('admin.store.owners') }}" class="admin-dashboard__menu-link">店舗代表者入力画面</a>
                </li>
                <li class="admin-dashboard__menu-item">
                    <a href="/back" class="admin-dashboard__menu-link">ホーム画面</a>
                </li>
                @endrole
            </ul>
        </nav>
        <div class="admin-dashboard__content">
            @yield('content')
        </div>
    </div>
</body>
</html>
