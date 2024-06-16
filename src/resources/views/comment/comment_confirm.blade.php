@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/comment/comment_confirm.css') }}">
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
            このコメントを本当に削除しますか？
        </h2>
        <p class="title__outer-p">
            ※一度削除すると元に戻せません
        </p>
    </div>
    <div class="comment__outer">
        <div class="comment">
            {{ $comment->comment }}
        </div>
    </div>
    <form action="{{ route('comment.remove') }}" method="post">
    @csrf
        <div class="remove__button-outer">
            <button class="remove__button" type="submit">
                コメントを削除する
            </button>
            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
            @if($itemId)
            <input type="hidden" name="item_id" value="{{ $itemId }}">
            @elseif($soldItemId)
            <input type="hidden" name="sold_item_id" value="{{ $soldItemId }}">
            @endif
        </div>
    </form>
</div>
@endsection