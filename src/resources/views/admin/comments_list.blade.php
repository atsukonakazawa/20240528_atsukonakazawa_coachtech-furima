@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/comments_list.css') }}">
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
                コメント管理画面
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
                        コメントid
                    </th>
                    <th class="item__name">
                        商品名
                    </th>
                    <th class="user__name">
                        コメント投稿者
                    </th>
                    <th class="comment">
                        コメント内容
                    </th>
                </tr>
                @foreach($comments as $comment)
                <form action="{{ route('admin.commentsRemove') }}" method="post">
                @csrf
                    <tr class="each__row">
                        <td class="id">
                            {{ $comment->id }}
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                        </td>
                        <td class="item__name">
                            @if($comment->item_id)
                            {{ $comment->item->item_name }}
                            @else($comment->soldItem_id)
                            {{ $comment->soldItem->item_name }}
                            @endif
                        </td>
                        <td class="user__name">
                            {{ $comment->user->name }}
                        </td>
                        <td class="comment">
                            {{ $comment->comment }}
                        </td>
                        <td class="delete">
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