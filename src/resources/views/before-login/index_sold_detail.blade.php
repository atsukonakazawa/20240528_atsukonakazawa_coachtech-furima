@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/before-login/sold_item.css') }}">
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
                <button type="button" class="open-modal">
                    <img src="{{ asset('img/white-star.jpeg') }}" alt="star">
                </button>
                <button type="button" class="open-modal">
                    <img src="{{ asset('img/comment.jpeg') }}" alt="comment">
                </button>
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
                            お気に入り・コメントはログイン後にご利用いただけます
                        </p>
                    </div>
                </div>
            </div>
            <!--ここまでモーダルウィンドウ-->

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
                    カラー：{{ $soldItem->color->color }}
                </p>
                <p class="detail">
                    説明：{{ $soldItem->item_detail }}
                </p>
            </div>
        </div>
    @endforeach
</div>
<script src="{{ asset('js/item.js') }}"></script>
@endsection