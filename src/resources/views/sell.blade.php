@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('search')
<div class="search__outer">
    <form id="search" action="{{ route('mypage.search') }}" method="get">
    @csrf
        <input class="search__input" type="text" name="search" onchange="submit(this.form)" placeholder="なにをお探しですか？" value="{{ session('selected_keyword') }}">
        @if (Auth::check())
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        @endif
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
    <div class="title__outer">
        <h2>
            商品の出品
        </h2>
    </div>
    <div class="input__group">
        <form action="{{ route('item.store') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="input__group-img">
                <p class="input__group-p">
                    商品画像
                </p>
                <div class="group__img">
                    <label class="file__label" for="item_img">
                        ファイルを選択
                        <input class="input__img" type="file" id="item_img"  name="item_img" value="{{ old('item_img') }}" >
                    </label>
                    <p class="file__none">
                        選択されていません
                    </p>
                    <p class="limit__p">
                        ※最大サイズは2048KBまでです。
                    </p>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(function() {
                        $('.file__label input[type=file]').on('change', function () {
                            var file = $(this).prop('files')[0];
                            if (file) {
                                $('.file__none').text(file.name);
                            } else {
                                $('.file__none').text('選択されていません');
                            }
                        });
                    });
                </script>
            </div>
            <div class="form__error">
            @error('item_img')
                {{ $message }}
            @enderror
            </div>

            <div class="subtitle__outer">
                <h3 class="subtitle">
                    商品の詳細
                </h3>
            </div>

            <div class="input__group-row">
                <p class="input__group-p">
                    メインカテゴリー
                </p>
                <select class="main__category-select" name="main_category_id">
                    <option disabled selected {{ old('main_category_id') == '' ? 'selected' : '' }} value="">選択してください</option>
                    @foreach($mainCategories as $mainCategory)
                    <option value="{{ $mainCategory['id'] }}" {{ old('main_category_id') == $mainCategory['id'] ? 'selected' : '' }}>
                        {{ $mainCategory['main_category'] }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
            @error('main_category_id')
                {{ $message }}
            @enderror
            </div>

            <div class="input__group-row">
                <p class="input__group-p">
                    サブカテゴリー
                </p>
                <select class="sub__category-select" name="sub_category_id">
                    <option disabled selected {{ old('sub_category_id') == '' ? 'selected' : '' }} value="">選択してください</option>
                    @foreach($subCategories as $subCategory)
                    <option value="{{ $subCategory['id'] }}" {{ old('sub_category_id') == $subCategory['id'] ? 'selected' : '' }}>
                        {{ $subCategory['sub_category'] }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
            @error('sub_category_id')
                {{ $message }}
            @enderror
            </div>

            <div class="input__group-row">
                <p class="input__group-p">
                    商品の状態
                </p>
                <select class="condition__select" name="condition_id">
                    <option disabled selected {{ old('condition_id') == '' ? 'selected' : '' }} value="">選択してください</option>
                    @foreach($conditions as $condition)
                    <option value="{{ $condition['id'] }}" {{ old('condition_id') == $condition['id'] ? 'selected' : '' }}>
                        {{ $condition['condition'] }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
            @error('condition_id')
                {{ $message }}
            @enderror
            </div>

            <div class="subtitle__outer">
                <h3 class="subtitle">
                    商品名と説明
                </h3>
            </div>

            <div class="input__group-row">
                <p class="input__group-p">
                    商品名
                </p>
                <input class="input__name" name="item_name" value="{{ old('item_name') }}" type="text" placeholder="プリンセス　靴下">
            </div>
            <div class="form__error">
            @error('item_name')
                {{ $message }}
            @enderror
            </div>

            <div class="input__group-row">
                <p class="input__group-p">
                    ブランド名
                </p>
                <input class="input__brand" name="item_brand" value="{{ old('item_brand') }}" type="text" placeholder="ディズニー">
            </div>
            <div class="form__error">
            @error('item_brand')
                {{ $message }}
            @enderror
            </div>

            <div class="input__group-row">
                <p class="input__group-p">
                    カラー
                </p>
                <select class="color__select" name="color_id">
                    <option disabled selected {{ old('color_id') == '' ? 'selected' : '' }} value="">選択してください</option>
                    @foreach($colors as $color)
                    <option value="{{ $color['id'] }}" {{ old('color_id') == $color['id'] ? 'selected' : '' }}>
                        {{ $color['color'] }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
            @error('color_id')
                {{ $message }}
            @enderror
            </div>

            <div class="input__group-row">
                <p class="input__group-p">
                    商品の説明
                </p>
                <input class="input__detail" name="item_detail" value="{{ old('item_detail') }}" type="text" placeholder="頂き物でしたがサイズが合わず一度も履くことがありませんでした。プリンセス好きなお子さんにいかがでしょうか。サイズは12センチです。">
            </div>
            <div class="form__error">
            @error('item_detail')
                {{ $message }}
            @enderror
            </div>

            <div class="subtitle__outer">
                <h3 class="subtitle">
                    販売価格
                </h3>
            </div>

            <div class="input__group-row">
                <p class="input__group-p">
                    販売価格
                </p>
                <input class="input__price" name="item_price" value="{{ old('item_price') }}" type="text" placeholder="1500">
            </div>
            <div class="form__error">
            @error('item_price')
                {{ $message }}
            @enderror
            </div>

            <div class="sell__button-outer">
                <button class="sell__button" type="submit">
                    出品する
                </button>
            </div>
            @if (Auth::check())
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            @endif
        </form>
    </div>
</div>
@endsection