@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/purchase.css') }}">
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
    <div class="img__outer">
        <img src="{{ asset('storage/' . basename($item->item_img)) }}" alt="商品画像">
    </div>

    <div class="item__data-outer">
        <div class="item__data">
            <h2 class="item__title">
                {{ $item->item_name }}
            </h2>
            <p class="item__price">
                ¥ {{ number_format($item->item_price) }}
            </p>
        </div>
        <div class="change__address-outer">
            <h3 class="change__address-title">
                配送先
            </h3>
            <div class="profile__address-outer">
                <div class="profile__postcode">
                    {{ $profile->postcode }}
                </div>
                <div class="profile__address">
                    {{ $profile->address }}
                </div>
                <div class="profile__address">
                    @if($profile->building)
                    {{ $profile->building }}
                    @endif
                </div>
            </div>
            <form action="{{ route('address.edit') }}">
            @csrf
                <div class="change-address__button-outer">
                    <button class="change-address__button" type="submit">
                        配送先住所を変更する
                    </button>
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <input type="hidden" name="profile_id" value="{{ $profile->id }}">
                </div>
            </form>
        </div>
        <form action="{{ route('item.payment') }}" method="get">
        @csrf
            <div class="payment__way-outer">
                <h3 class="payment__way-title">
                    支払い方法
                </h3>
                <select class="payment__way-select" name="payment_way_id">
                    @foreach($paymentWays as $paymentWay)
                        <option value="{{ $paymentWay['id'] }}">
                            {{ $paymentWay['payment_way'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="purchase__button-outer">
                <button class="purchase__button" type="submit">
                    購入を確定する
                </button>
                <p class="purchase__button-p">
                    ※決済画面に移ります
                </p>
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            </div>
        </form>
    </div>
</div>
@endsection