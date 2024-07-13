@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/purchase.css') }}">
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
    <div class="item__data-outer">
        <div class="upper__part">
            <div class="img__outer">
                <img class="img__outer-img" src="{{ asset('storage/items/' . basename($item->item_img)) }}" alt="商品画像">
            </div>
            <div class="item__data">
                <h2 class="item__title">
                    {{ $item->item_name }}
                </h2>
                <p class="item__price">
                    ¥ {{ number_format($item->item_price) }}
                </p>
            </div>
        </div>
        <div class="change__address-outer">
            <h3 class="change__address-title">
                配送先
            </h3>
            <div class="profile__address-outer">
                <div class="profile__postcode">
                    〒{{ $profile->postcode }}
                </div>
                <div class="profile__address">
                    {{ $profile->address }}
                </div>
                <div class="profile__building">
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
            <div class="payment__way-select-outer" >
                <select class="payment__way-select" name="payment_way_id" id="payment_way">
                    <option value="" selected disabled>
                        選択してください
                    </option>
                    @foreach($paymentWays as $paymentWay)
                        <option value="{{ $paymentWay['id'] }}">
                            {{ $paymentWay['payment_way'] }}
                        </option>
                    @endforeach
                </select>
                <p class="payment__p">
                    ※コンビニ払いと銀行振込はご入金確認後に商品発送となります
                </p>
            </div>
        </div>
    </div>
    <div class="confirm__box">
        <table class="confirm__table">
            <tr class="confirm__price-row">
                <th>
                    商品代金
                </th>
                <td>
                    ¥ {{ number_format($item->item_price) }}
                </td>
            </tr>
            <tr class="confirm-payment__price-row">
                <th>
                    支払い金額
                </th>
                <td>
                    ¥ {{ number_format($item->item_price) }}
                </td>
            </tr>
            <tr class="confirm-payment__way-row">
                <th>
                    支払い方法
                </th>
                <td id="confirmTime">
                    <span class="output__payment-way">
                </td>
            </tr>
        </table>
        <div class="purchase__button-outer">
            <div class="form__error">
            @error('payment_way_id')
                {{ $message }}
            @enderror
            </div>
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
<script src="{{ asset('js/purchase.js') }}"></script>
@endsection