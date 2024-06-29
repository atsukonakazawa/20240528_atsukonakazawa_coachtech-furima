@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/before-login/index_sold_detail.css') }}">
@endsection

@section('search')
<div class="search__outer">
    <form id="search" action="{{ route('top.search') }}" method="get">
    @csrf
        <input class="search__input" type="text" name="search" onchange="submit(this.form)" placeholder="なにをお探しですか？" value="{{ session('selected_keyword') }}">
    </form>
</div>
@endsection

@section('login')
<div class="login__outer">
    <a href="/login">
        ログイン
    </a>
</div>
@endsection

@section('register')
<div class="register__outer">
    <a href="/register">
        会員登録
    </a>
</div>
@endsection

@section('sell')
<div class="create__link-outer">
    <form action="{{ route('item.create') }}" method="get">
    @csrf
        <button class="open-modal">
            出品
        </button>
    </form>
</div>
<!--ここからモーダルウィンドウ-->
<div id="modal" class="modal">
    <!-- ここからモーダルコンテンツ -->
    <div class="modal__content">
        <div class="close-button__outer">
            <button class="close">
                &times;
            </button>
        </div>
        <div class="modal__message-outer">
            <p class="modal__message">
                出品はログイン後にご利用いただけます
            </p>
        </div>
    </div>
</div>
<!--ここまでモーダルウィンドウ-->
@endsection

@section('content')
<div class="content__outer">
    @foreach($soldItems as $soldItem)
        <div class="img__outer">
            <img src="{{ asset('storage/sold_items/' . basename($soldItem->item_img)) }}">
            <div class="sold__mark">
                <p class="sold">SOLD</p>
            </div>
        </div>
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
            <a class="icon__group" href="/login">
                <button class="star__button" type="button">
                    <img class="star__img" src="{{ asset('img/white-star.jpeg') }}" alt="star">
                </button>
                <button class="comment__button" type="button">
                    <img class="comment__img" src="{{ asset('img/comment.jpeg') }}" alt="comment">
                </button><br>
            </a>
            <div class="counts">
                <p class="favorites__counts">{{ $favoritesCount }}</p> <!-- お気に入り数を表示 -->
                <p class="comments__counts">{{ $commentsCount }}</p> <!-- コメント数を表示 -->
            </div>
            <a class="purchase__button-outer" href="/login">
                <button class="purchase__button" type="button" disabled>
                    購入する
                </button>
            </a>
            <p class="purchase__button-p">
                ※お気に入り・コメント・購入はログイン後にご利用いただけます
            </p>
            <div class="detail__group">
                <h3 class="detail__title">
                    商品説明
                </h3>
                <p class="condition">
                    商品の状態：{{ $soldItem->condition->condition }}
                </p>
                <p class="main__catogory">
                    メインカテゴリー：{{ $soldItem->mainCategory->mian_category }}
                </p>
                <p class="sub__catogory">
                    サブカテゴリー：{{ $soldItem->subCategory->sub_category }}
                </p>
                <p class="color">
                    カラー：{{ $soldItem->color->color }}
                </p>
                <p class="detail">
                    説明：{{ $soldItem->item_detail }}
                </p>
            </div>
        </div>
    @endforeach
</div>
@endsection