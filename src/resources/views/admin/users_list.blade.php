@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/users_list.css') }}">
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
                会員管理画面
            </h2>
        </div>
        <div class="message__outer">
            <p class="message">
            @if(session('message'))
                {{ session('message')}}
            @endif
            </p>
        </div>
        <div class="table__outer">
            <table class="table">
                <tr class="title__row">
                    <th class="id">
                        会員id
                    </th>
                    <th class="name">
                        会員氏名
                    </th>
                    <th class="nickname">
                        ユーザー名
                    </th>
                    <th class="email">
                        メールアドレス
                    </th>
                    <th class="address">
                        住所
                    </th>
                </tr>
                @foreach($users as $user)
                <form action="{{ route('admin.usersRemove') }}" method="post">
                @csrf
                    <tr class="each__row">
                        <td class="id">
                            {{ $user->id }}
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                        </td>
                        <td class="name">
                            {{ $user->name }}
                        </td>
                        <td class="nickname">
                            {{ $user->profile->nickname }}
                        </td>
                        <td class="email">
                            {{ $user->email }}
                        </td>
                        <td class="address">
                            {{ $user->profile->address }}
                        </td>
                        <td class=" delete">
                            <button class="delete__button">
                                削除
                            </button>
                        </td>
                    </tr>
                </form>
                @endforeach
            </table>
        </div>
        <div class="admin__button-outer">
            <form action="{{ route('admin.menu') }}" method="get">
                <button class="admin__button" type="submit">
                    管理者画面へ戻る
                </button>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            </form>
        </div>
    </div>
@endsection