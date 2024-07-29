@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
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
    <div class="title__outer">
        <form class="home__form" action="{{ route('item.home') }}" method="get">
        @csrf
        <button class="home__button" type="submit">
            おすすめ
        </button>
        </form>
        <form class="favorite__form" action="{{ route('favorite.list') }}" method="get">
        @csrf
        <button class="favorite__list-button" type="submit">
            マイリスト
        </button>
        </form>
    </div>
    <!--商品一覧-->
    <div class="items__outer">
        @foreach($items as $item)
            <form action="{{ route('home.detail_item') }}" method="get">
            @csrf
                <button class="each__item" type="submit">
                    <div class="item__box">
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <div class="item__img">
                            <img src="{{ $item->item_img }}" alt="商品画像">
                        </div>
                        <div class="price__outer">
                            <p class="price">
                                ¥ {{ number_format($item->item_price) }}
                            </p>
                        </div>
                    </div>
                </button>
            </form>
        @endforeach
        @foreach($soldItems as $soldItem)
            <form action="{{ route('home.detail_sold') }}" method="get">
            @csrf
                <button class="each__item" type="submit">
                    <div class="item__box">
                        <input type="hidden" name="soldItem_id" value="{{ $soldItem->id }}">
                        <div class="item__img-group">
                            <img src="{{ $soldItem->item_img }}" alt="商品画像">
                            <div class="sold__mark">
                                <p class="sold">SOLD</p>
                            </div>
                        </div>
                        <div class="price__outer">
                            <p class="price">
                                ¥ {{ number_format($soldItem->item_price) }}
                            </p>
                        </div>
                    </div>
                </button>
            </form>
        @endforeach
    </div>
    <!--管理者画面はこちら-->
    <div class="admin__button-outer">
        <form action="{{ route('admin.menu') }}" method="get">
            <button class="admin__button" type="submit">
                管理者画面はこちら
            </button>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        </form>
        <div class="message__outer">
            <p class="message">
            @if(session('message'))
                {{ session('message')}}
            @endif
            </p>
        </div>
    </div>
</div>
@endsection