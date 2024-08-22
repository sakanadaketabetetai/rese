<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    @yield('css')
    <title>Rese</title>
</head>
<body>
    <header class="header">
        <div class="header_inner">
            <div class="header-utilities">
                <div class="header-menu">
                    @if( Request::routeIs('register') )
                    <div class="header-menu_item">
                        <a href="/register_menu" class="header-menu_link"><img src="/storage/images/メニューのフリーアイコン19.png"></a>
                        <a href="/" class="header_logo">Rese</a>
                    </div>
                    @endif
                </div>
                <div class="header-menu">
                    @if( Request::routeIs('login') )
                    <div class="header-menu_item">
                        <a href="/login_menu" class="header-menu_link"><img src="/storage/images/メニューのフリーアイコン19.png"></a>
                        <a href="/" class="header_logo">Rese</a>
                    </div>
                    @endif
                </div>
                <div class="header-menu">
                    @if( Auth::user() )
                    <div class="header-menu_item">
                        <a href="/user_menu" class="header-menu_link"><img src="/storage/images/メニューのフリーアイコン19.png"></a>
                        <a href="/" class="header_logo">Rese</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="content">
            @yield('content')
        </div>
    </main>
</body>
</html>