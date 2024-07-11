@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/email_sent.css') }}">
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
            メールを送信しました
        </h2>
    </div>
    <div class="admin__button-outer">
        <form action="{{ route('admin.menu') }}" method="get">
            <button class="admin__button" type="submit">
                管理者専用画面に戻る
            </button>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        </form>
    </div>
</div>
@endsection