@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<div class="content__outer">
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
                    <p class="email__p">
                        メールアドレス
                    </p>
                    <input class="email__input" type="text" name="email" value="{{ old('email') }}" placeholder="kouchi@example.com"/>
                    <div class="form__error">
                    @error('email')
                        {{ $message }}
                    @enderror
                    </div>
                </div>

                <div class="password__row">
                    <p class="password__p">
                        パスワード
                    </p>
                    <input class="password__input" name="password" type="password" value="{{ old('password') }}" placeholder="kouchi123（8文字以上）">
                    <div class="form__error">
                    @error('password')
                        {{ $message }}
                    @enderror
                    </div>
                </div>

                <div class="login__button-outer">
                    <button class="login__button" type="submit">
                        ログイン
                    </button>
                </div>
            </div>
            <div class="to__register">
                <a href="/register">
                    会員登録はこちら
                </a>
            </div>
        </form>
    </div>
</div>
@endsection