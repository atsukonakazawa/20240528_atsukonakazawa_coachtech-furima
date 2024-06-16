@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/payment_credit.css') }}">
@endsection

@section('content')
    <form class="pay-form" action="/pay" method="POST">
        @csrf
        <div class="payment__title-outer">
            <h2 class="payment__title">
                クレジット決済画面
            </h2>
            <p class="name">
                {{ $user->name }}　さま
            </p>
        </div>
        <p class="price" name="itemPrice">
            ¥ {{ number_format($item->item_price) }}
        </p>

        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ env('STRIPE_KEY') }}"
            data-name="Stripe決済デモ"
            data-label="支払い情報を入力する"
            data-description="これはデモ決済です"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-currency="JPY">
        </script>
    </form>
@endsection

