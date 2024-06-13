@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/after-login/home_item.css') }}">
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
                <button type="submit">
                    <img src="{{ asset('img/comment.jpeg') }}" alt="comment">
                </button>
            </div>

            <a class="purchase__button" href="/login">
                <button type="button">
                    購入する
                </button>
            </a>
            <div class="detail__group">
                <h3 class="detail__title">
                    商品説明
                </h3>
                <p class="condition">
                    商品の状態：{{ $item->condition->condition }}
                </p>
                <p class="main__category">
                    メインカテゴリー：{{ $item->mainCategory->main_category }}
                </p>
                <p class="sub__category">
                    サブカテゴリー：{{ $item->subCategory->sub_category }}
                </p>
                <p class="color">
                    カラー：{{ $item->item_color }}
                </p>
                <p class="detail">
                    説明：{{ $item->item_detail }}
                </p>
            </div>
        </div>
    @endforeach
</div>
@endsection