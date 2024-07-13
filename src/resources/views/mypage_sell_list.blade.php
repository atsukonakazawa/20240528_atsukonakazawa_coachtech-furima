@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage_sell_list.css') }}">
@endsection

@section('search')
<div class="search__outer">
    <form id="search" action="{{ route('mypage.search') }}" method="get">
    @csrf
        <input class="search__input" type="text" name="search" onchange="submit(this.form)" placeholder="販売した商品から検索" value="{{ session('selected_keyword') }}">
        @if (Auth::check())
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        @endif
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
    <div class="user__part">
        <div class="user__img-outer">
            <img class="user__img" src="{{ asset('storage/profiles/' . basename($profile->img)) }}" alt="user_img">
        </div>
        <div class="user__nickname-outer">
            <p class="user__nickname">
                {{ $profile->nickname }}
            </p>
        </div>
        <div class="to-profile__button-outer">
            <form action="{{ route('profile.edit') }}" method="get">
            @csrf
                <button class="to-profile__button">
                    プロフィールを編集
                </button>
                @if (Auth::check())
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                @endif
            </form>
        </div>
    </div>
    <div class="title__outer">
        <form action="{{ route('mypage.selllist') }}" method="get">
        @csrf
            <button class="sell__list-button" type="submit">
                出品した商品
            </button>
            @if (Auth::check())
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            @endif
        </form>
        <form action="{{ route('mypage.purchasedlist') }}" method="get">
        @csrf
            <button class="purchased__list-button" type="submit">
                購入した商品
            </button>
            @if (Auth::check())
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            @endif
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
                            <img src="{{ asset('storage/items/' . basename($item->item_img)) }}" alt="商品画像">
                        </div>
                        <div class="price__outer">
                            <div class="price">
                                ¥ {{ number_format($item->item_price) }}
                            </div>
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
                            <img src="{{ asset('storage/sold_items/' . basename($soldItem->item_img)) }}" alt="商品画像">
                            <div class="sold__mark">
                                <p class="sold">SOLD</p>
                            </div>
                        </div>
                        <div class="price__outer">
                            <div class="price">
                                ¥ {{ number_format($soldItem->item_price) }}
                            </div>
                        </div>
                    </div>
                </button>
            </form>
        @endforeach
    </div>
</div>
@endsection