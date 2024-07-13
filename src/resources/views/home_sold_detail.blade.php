@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home_sold_detail.css') }}">
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
                    <button class="star__button"  type="submit" onclick="toggleLike(this, {{ $soldItem->id }})" >
                        <img class="star__img" src="{{ in_array($soldItem->id, $favorites) ? asset('img/yellow-star.jpeg') :  asset('img/white-star.jpeg')}}" alt="star">
                    </button>
                    <input type="hidden" name="sold_item_id" value="{{ $soldItem->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                </form>
                <form action="{{ route('comment.listSold') }}" method="get">
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
            <button class="purchase__button" type="button" disabled>
                SOLD
            </button>
            <div class="detail__group">
                <h3 class="detail__title">
                    商品説明
                </h3>
                <p class="condition">
                    商品の状態：{{ $soldItem->condition->condition }}
                </p>
                <p class="main__category">
                    メインカテゴリー：{{ $soldItem->mainCategory->main_category }}
                </p>
                <p class="sub__category">
                    サブカテゴリー：{{ $soldItem->subCategory->sub_category }}
                </p>
                <p class="color">
                    カラー：{{ $soldItem->color->color }}
                </p>
                <p class="detail">
                    説明：{{ $soldItem->item_detail }}
                </p>
                                <div class="seller__outer">
                    <p class="seller">
                        出品者
                    </p>
                    <div class="user__img-outer">
                        <img class="user__img" src="{{ asset('storage/profiles/' . basename($soldItem->seller->profile->img)) }}" alt="user_img">
                    </div>
                    <p class="seller__name">
                        {{ $soldItem->seller->profile->nickname }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection