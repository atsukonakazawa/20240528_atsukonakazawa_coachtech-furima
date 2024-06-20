@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<div class="content-outer">
    <div class="content">
        <div class="message-outer">
            <p class="message">
            @if(session('message'))
                {{ session('message')}}
            @endif
            @if($errors->any())
                @foreach($errors->all() as $error)
                {{ $error }}
                @endforeach
            @endif
            </p>
        </div>
        <form action="/login" method="post">
        @csrf
            <div class="login__box">
                <h2 class="title">
                    ログイン
                </h2>

                <div class="email__row">
                    <p class="email">
                        メールアドレス
                    </p>
                    <input class="email" type="text" name="email" value="{{ old('email') }}" placeholder="kouchi@example.com"/>
                </div>
                <div class="form__error">
                @error('email')
                    {{ $message }}
                @enderror
                </div>

                <div class="password__row">
                    <p class="password">
                        パスワード
                    </p>
                    <input class="password" name="password" type="password" value="{{ old('password') }}" placeholder="kouchi123（8文字以上）">
                </div>
                <div class="form__error">
                @error('password')
                    {{ $message }}
                @enderror
                </div>

                <div class="login-button__outer">
                    <button class="login-button" type="submit">
                        ログイン
                    </button>
                </div>
            </div>
        </form>
        <div class="to__register">
            <a href="/register">
                会員登録はこちら
            </a>
        </div>
    </div>
    @if (Auth::check())
        <li>
            <form class="logout-form" action="/logout" method="post">
                @csrf
                <button class="logout-button">
                    ログアウト
                </button>
            </form>
        </li>
    @endif

</div>
@endsection