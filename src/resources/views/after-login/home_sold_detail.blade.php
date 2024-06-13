@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/before-login/sold_item.css') }}">
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
    @foreach($soldItems as $soldItem)
        <div class="img__outer">
            <img src="{{ asset('storage/' . basename($soldItem->item_img)) }}">
        </div>
        <p class="sold__mark">
            sold
        </p>

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
                    <button type="submit" onclick="toggleLike(this, {{ $soldItem->id }})" >
                        <img src="{{ in_array($soldItem->id, $favorites) ? asset('img/yellow-star.jpeg') :  asset('img/white-star.jpeg')}}" alt="star">
                    </button>
                    <input type="hidden" name="sold_item_id" value="{{ $soldItem->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                </form>
                <button type="button">
                    <img src="{{ asset('img/comment.jpeg') }}" alt="comment">
                </button>
            </div>

            <a class="purchase__button" href="/login">
                <button type="button" disabled>
                    購入する
                </button>
            </a>
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
                    カラー：{{ $soldItem->item_color }}
                </p>
                <p class="detail">
                    説明：{{ $soldItem->item_detail }}
                </p>
            </div>
        </div>
    @endforeach
</div>
@endsection