@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/payment_credit.css') }}">
@endsection

@section('content')
<div class="content__outer">
    <form class="pay__form" action="{{ route('pay.credit') }}" method="POST">
        @csrf
        <div class="payment__title-outer">
            <h2 class="payment__title">
                クレジット決済画面
            </h2>
            <p class="name">
                {{ $user->name }}　さま
            </p>
            <p class="price" name="itemPrice">
                ¥ {{ number_format($item->item_price) }}
            </p>
        </div>
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ env('STRIPE_KEY') }}"
            data-amount="{{ $item->item_price }}"
            data-name="Stripe決済デモ"
            data-label="決済をする"
            data-description="これはデモ決済です"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-currency="JPY">
        </script>
        <input type="hidden" name="item_price" value="{{ $item->item_price }}">
        <input type="hidden" name="item_id" value="{{ $item->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="payment_way_id" value="1">
    </form>
</div>
@endsection