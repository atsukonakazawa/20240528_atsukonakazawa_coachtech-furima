@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/create_email.css') }}">
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
        <form action="{{ route('admin.send') }}" method="post">
        @csrf
            <div class="title__outer">
                <h2 class="title">
                    メール作成画面
                </h2>
            </div>
            <div class="create__outer">
                <div class="row">
                    <label class="user__name-label" for="user__name">
                        会員氏名：
                    </label>
                    <p class="user__name-p" name="user_name">
                        {{ $user->name }}
                    </p>
                    <input type="hidden" name="user_name" value="{{ $user->name }}">
                </div>
                <div class="row">
                    <label class="user__email-label" for="user__email">
                        メールアドレス：
                    </label>
                    <p class="user__email-address" name="user_email">
                        {{ $user->email }}
                    </p>
                    <input type="hidden" name="user_email" value="{{ $user->email }}">
                </div>
                <div class="row">
                    <label class="email__title-label" for="email__title">
                        件名：
                    </label>
                    <input class="email__title-input" name="email_title" type="text">
                </div>
                <div class="row">
                    <label class="email__body-label" for="email__body">
                        本文：
                    </label>
                    <textarea class="email__body-textarea" name="email_body" id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="send__button-outer">
                <button class="send__button" type="submit">
                    送信する
                </button>
            </div>
        </form>
    </div>
@endsection