@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/comment/comment_list_sold.css') }}">
<style>
    .user__row {
        width: 100%;
        display: flex;
        margin-top: 30px;
    }
    .user__row-right{
        width: 100%;
        display: flex;
        justify-content:flex-end;
        margin-top: 30px;
    }
</style>
@endsection

@section('search')
<div class="search__outer">
    <form id="search" action="{{ route('item.search') }}" method="get">
    @csrf
        <input class="search__input" type="text" name="search" onchange="submit(this.form)" placeholder="なにをお探しですか？" value="{{ session('selected_keyword') }}">
    </form>
</div>
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
<div class="home__header-outer">
    <form action="{{ route('item.home') }}" method="get">
    @csrf
        <button class="home__header-button" type="submit">
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
    @foreach($soldItems as $soldItem)
        <div class="img__outer">
            <img src="{{ asset('storage/sold_items/' . basename($soldItem->item_img)) }}" alt="商品画像">
            <div class="sold__mark">
                <p class="sold">SOLD</p>
            </div>
        </div>
        <div class="detail__outer-group">
            <div class="detail__outer">
                <h2 class="item__title">
                    {{ $soldItem->item_name }}
                </h2>
                <p class="brand">
                    ブランド名：{{ $soldItem->item_brand }}
                </p>
                <p class="price">
                    ¥ {{ number_format($soldItem->item_price) }}
                </p>
                <div class="icon__group">
                    <form action="{{ route('solditem.favorite') }}" method="get">
                    @csrf
                        <button class="star__button" type="submit" onclick="toggleLike(this, {{ $soldItem->id }})">
                            <img class="star__img" src="{{ in_array($soldItem->id, $favorites) ? asset('img/yellow-star.jpeg') :  asset('img/white-star.jpeg')}}" alt="star">
                        </button>
                        <input type="hidden" name="sold_item_id" value="{{ $soldItem->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </form>
                    <form action="{{ route('comment.list') }}" method="get">
                    @csrf
                        <button class="comment__button" type="submit">
                            <img class="comment__img" src="{{ asset('img/comment.jpeg') }}" alt="comment">
                        </button>
                        <input type="hidden" name="sold_item_id" value="{{ $soldItem->id }}">
                    </form>
                </div>
                <div class="counts">
                    <p class="favorites__counts">{{ $favoritesCount }}</p> <!-- お気に入り数を表示 -->
                    <p class="comments__counts">{{ $commentsCount }}</p> <!-- コメント数を表示 -->
                </div>
            </div>
            <div class="comment__list-outer">
                <div class="comment__list">
                    @foreach($comments as $comment)
                        <div class="{{ $comment->user_id == $user->id ? 'user__row-right' : 'user__row' }}">
                            <div class="comment-user__img-outer">
                                <img class="comment-user__img" src="{{ asset('storage/profiles/' . basename($comment->user->profile->img)) }}" alt="user_img">
                            </div>
                            <div class="comment__user">
                                {{ $comment->user->profile->nickname }}
                            </div>
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
                                    <input type="hidden" name="sold_item_id" value="{{ $soldItem->id }}">
                                </div>
                            </form>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection