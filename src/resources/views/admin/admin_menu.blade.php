@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin_menu.css') }}">
@endsection

@section('logout')
<div class="logout__outer">
    <form action="/logout" method="post">
    @csrf
        <button class="logout__button">
            ログアウト
        </button>
    </form>
</div>
@endsection

@section('home')
<div class="home__header-outer">
    <form action="{{ route('item.home') }}" method="get">
    @csrf
        <button class="home__header-button" type="submit">
            ホーム
        </button>
    </form>
</div>
@endsection

@section('content')
    <div class="content__outer">
        <div class="title__outer">
            <h2 class="title">
                管理者専用画面
            </h2>
        </div>
        <div class="menu__button-outer">
            <form action="{{ route('admin.users') }}" method="get">
            @csrf
                <button class="menu__button" type="submit">
                    会員管理画面へ
                </button>
            </form>
            <form action="{{ route('admin.comments') }}" method="get">
            @csrf
                <button class="menu__button" type="submit">
                    コメント管理画面へ
                </button>
            </form>
            <form action="" method="get">
            @csrf
                <button class="menu__button" type="submit">
                    利用者にメールを送る
                </button>
            </form>
        </div>
    </div>
@endsection