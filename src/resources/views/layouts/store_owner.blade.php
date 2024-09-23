<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>店舗代表者管理画面</title>
    <link rel="stylesheet" href="{{ asset('css/store_owner.css') }}">
    @yield('css')
</head>
<body>
    <div class="layout">
        <!-- サイトメニュー -->
        <nav class="sidebar">
            <div class="sidebar__title">
                管理メニュー
            </div>
            <ul class="sidebar__menu">
                @role('store_owner')
                <li class="sidebar__menu-item">
                    <a class="sidebar__menu-link" href="{{ route('store.info') }}">店舗情報</a>
                </li>
                <li class="sidebar__menu-item">
                    <a class="sidebar__menu-link" href="{{ route('store.reservation') }}">予約情報一覧</a>
                </li>
                <li class="sidebar__menu-item">
                    <a class="sidebar__menu-link" href="{{ route('store.info.input') }}">店舗情報作成</a>
                </li>
                <li class="sidebar__menu-item">
                    <a class="sidebar__menu-link" href="/back">ホーム画面</a>
                </li>
                @endrole
            </ul>
        </nav>
        <div class="content">
            @yield('content')
            @yield('scripts')
        </div>
    </div>
</body>
</html>
