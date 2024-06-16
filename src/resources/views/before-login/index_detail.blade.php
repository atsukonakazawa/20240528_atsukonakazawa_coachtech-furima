@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/before-login/item.css') }}">
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
                <button type="purchase__button">
                    購入する
                </button>
            </a>
            <p class="purchase__button-p">
                ※ログインが必要となります
            </p>
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
                    カラー：{{ $item->color->color }}
                </p>
                <p class="detail">
                    説明：{{ $item->item_detail }}
                </p>
            </div>
        </div>
    @endforeach
</div>
<script src="{{ asset('js/item.js') }}"></script>
@endsection