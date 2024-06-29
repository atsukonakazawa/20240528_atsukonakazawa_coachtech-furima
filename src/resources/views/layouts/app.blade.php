<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coachtech Furima</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body class="body">
    <header class="header">
        <div class="header__inner">
            <div class="header__logo-outer">
                <a class="header__logo-a" href="/">
                    <img class="header__logo-img" src="{{ asset('img/logo.svg') }}" alt="ヘッダーロゴ">
                </a>
            </div>
            <div class="options">
                <div class="search__option">
            @yield('search')
                </div>
                <div class="other__options">
                    @yield('login')
                    @yield('register')
                    @yield('mypage')
                    @yield('home')
                    @yield('logout')
                    @yield('sell')
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        @yield('content')
    </main>
</body>
</html>