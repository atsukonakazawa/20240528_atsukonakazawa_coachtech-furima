@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/payment_conbini.css') }}">
@endsection

@section('content')
<div class="content__outer">
    <div class="title__outer">
        <h2 class="title">
            コンビニ払いご案内ページ
        </h2>
        <p class="title__p">
            ご購入ありがとうございます！
        </p>
    </div>
    <div class="table__outer">
        <table class="table">
            <tr class="tr">
                <th>お支払い番号</th>
                <td>1234123412341234</td>
            </tr>
            <tr class="tr">
                <th>確認番号</th>
                <td>12345</td>
            </tr>
        </table>
    </div>
    <p class="table__outer-p">
        ※ご入金確認後に商品発送となります
    </p>
    <p class="table__outer-p">
        ※購入日から１週間が経過してもご入金が確認できない場合は<br>
        お取引がキャンセルとなる場合があります
    </p>
    <div class="back__button-outer">
        <form action="{{ route('mypage.purchasedlist') }}" method="get">
        @csrf
            <button class="purchased__list-button" type="submit">
                購入した商品一覧を見る
            </button>
            @if (Auth::check())
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            @endif
        </form>
    </div>

</div>
@endsection