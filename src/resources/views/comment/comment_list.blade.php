@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/comment/comment_list.css') }}">
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
    @foreach($items as $item)
        <div class="img__outer">
            <img src="{{ asset('storage/' . basename($item->item_img)) }}" alt="商品画像">
        </div>

        <div class="detail__outer">
            <h2 class="item__title">
                {{ $item->item_name }}
            </h2>
            <p class="brand">
                ブランド名：{{ $item->item_brand }}
            </p>
            <p class="price">
                ¥ {{ number_format($item->item_price) }}
            </p>
            <div class="icon__group">
                <form action="{{ route('item.favorite') }}" method="get">
                @csrf
                    <button type="submit" onclick="toggleLike(this, {{ $item->id }})">
                        <img src="{{ in_array($item->id, $favorites) ? asset('img/yellow-star.jpeg') :  asset('img/white-star.jpeg')}}" alt="star">

                    </button>
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                </form>
                <form action="{{ route('comment.list') }}" method="get">
                @csrf
                    <button type="submit">
                        <img src="{{ asset('img/comment.jpeg') }}" alt="comment">
                    </button>
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                </form>
            </div>
        </div>

        <div class="comment__list-outer">
            <div class="comment__list">
                @foreach($comments as $comment)
                    <div class="comment__user-img">
                    <img src="{{ asset('storage/' . basename($comment->user->profile->img)) }}" alt="user_img">
                    </div>
                    <div class="comment__user">
                        {{ $comment->user->profile->nickname }}
                    </div>
                    <div class="comment__content">
                        {{ $comment->comment }}
                    </div>
                    @if( $comment->user_id == $user->id )
                        <form action="{{ route('comment.confirm') }}" method="get">
                        @csrf
                            <div class="comment-delete__button-outer">
                                <button class="comment-delete__button" type="submit" value="back">
                                    削除
                                </button>
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                            </div>
                        </form>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="comment__create-outer">
            <form action="{{ route('comment.send') }}">
            @csrf
                <p class="comment__create-p">
                    商品へのコメント（50文字以内）
                </p>
                <input class="comment__create" name="comment" type="text">
                <div class="form__error">
                    @error('comment')
                        {{ $message }}
                    @enderror
                </div>
                <div class="comment-send__button-outer">
                    <button class="comment-send__button" type="submit">
                        コメントを送信する
                    </button>
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                </div>
            </form>
        </div>
    @endforeach
</div>
@endsection