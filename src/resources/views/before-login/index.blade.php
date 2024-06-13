@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/before-login/index.css') }}">
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
<div class="sell__outer">
    <a href="/login" class="open-modal">
        出品
    </a>
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
        <div class="message__outer">
            <p class="message">
                出品はログイン後にご利用いただけます
            </p>
        </div>
    </div>
</div>
<!--ここまでモーダルウィンドウ-->

@endsection

@section('content')
<div class="content__outer">
    <div class="title__outer">
        <h2 class="title">
            おすすめ
        </h2>
    </div>
    <!--商品一覧-->
    <div class="items__outer">
        @foreach($items as $item)
            <form action="{{ route('top.detail_item') }}" method="get">
            @csrf
                <button type="submit">
                    <div class="item__box">
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <div class="item__img">
                            <img src="{{ asset('storage/' . basename($item->item_img)) }}" alt="商品画像">
                        </div>
                        <div class="price__outer">
                            <p class="price">
                                {{$item->item_price}}
                            </p>
                        </div>
                    </div>
                </button>
            </form>
        @endforeach
        @foreach($soldItems as $soldItem)
            <form action="{{ route('top.detail_sold') }}" method="get">
            @csrf
                <div class="item__box">
                    <button type="submit">
                        <input type="hidden" name="soldItem_id" value="{{ $soldItem->id }}">
                        <div class="item__img-group">
                            <img src="{{ asset('storage/' . basename($soldItem->item_img)) }}" alt="商品画像">
                            <p class="sold__mark">
                                sold
                            </p>
                        </div>
                        <div class="price__outer">
                            <p class="price">
                                {{$soldItem->item_price}}
                            </p>
                        </div>
                    </button>
                </div>
            </form>
        @endforeach
    </div>
</div>
<script src="{{ asset('js/item.js') }}"></script>
@endsection