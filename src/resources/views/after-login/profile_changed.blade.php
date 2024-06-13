@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/after-login/profile_changed.css') }}">
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

@section('mypage')
<div class="mypage__button-outer">
    <form action="{{ route('mypage.selllist') }}">
    @csrf
        <button class="mypage__button" type="submit">
            マイページ
        </button>
        @if (Auth::check())
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        @endif
    </form>
</div>
@endsection

@section('home')
<div class="home__outer">
    <form action="{{ route('item.home') }}" method="get">
    @csrf
        <button class="home__button" type="submit">
            ホーム
        </button>
    </form>
</div>
@endsection

@section('sell')
<div class="create__link-outer">
    <form action="{{ route('item.create') }}" method="get">
    @csrf
        <button class="sell-create__button">
            出品
        </button>
    </form>
</div>
@endsection

@section('content')
<div class="content__outer">
    <div class="title__outer">
        <h2 class="title">
            プロフィールを更新しました
        </h2>
    </div>
</div>
@endsection