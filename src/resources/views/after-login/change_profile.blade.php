@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/after-login/change_profile.css') }}">
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
    <div class="title__outer">
        <h2>
            プロフィール設定
        </h2>
    </div>
    <div class="user__part">
        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf

            <div class="user__part-row">
                <img src="{{ asset('storage/' . basename($profile->img)) }}" alt="user_img">
                <input class="user__part-input" type="file" id="img" name="newImg" value="{{ old('img') }}" >
                <p class="limit__p">
                    ※取扱可能な画像形式はjpeg,jpg,svgです。
                </p>
                <p class="limit__p">
                    ※最大サイズは2048KBまでです。
                </p>
            </div>
            <div class="form__error">
            @error('img')
                {{ $message }}
            @enderror
            </div>

            <div class="user__part-row">
                <p class="user__part-p">
                    ユーザー名
                </p>
                <input class="user__part-input" name="newNickname" value="{{ old('nickname') }}" type="text" placeholder="{{ $profile->nickname }}">
                <p class="limit__p">
                    ※アプリ上で公開される名前となります
                </p>
            </div>
            <div class="form__error">
            @error('nickname')
                {{ $message }}
            @enderror
            </div>

            <div class="user__part-row">
                <p class="user__part-p">
                    郵便番号
                </p>
                <input class="user__part-input" id="postcode" name="newPostcode" value="{{ old('postcode') }}" type="text" placeholder="{{ $profile->postcode }}" onblur="fetchAddress()">
            </div>
            <div class="form__error">
            @error('postcode')
                {{ $message }}
            @enderror
            </div>

            <div class="user__part-row">
                <p class="user__part-p">
                    住所
                </p>
                <input class="user__part-input" id="address" name="newAddress" value="{{ old('address') }}" type="text" placeholder="{{ $profile->address }}">
            </div>
            <div class="form__error">
            @error('address')
                {{ $message }}
            @enderror
            </div>

            <div class="user__part-row">
                <p class="user__part-p">
                    建物名
                </p>
                <input class="user__part-input" name="newBuilding" value="{{ old('building') }}" type="text" placeholder="{{ $profile->building }}">
            </div>
            <div class="form__error">
            @error('building')
                {{ $message }}
            @enderror
            </div>

            <div class="user__part-row">
                <p class="user__part-p">
                    自己紹介文
                </p>
                <input class="user__part-input" name="newIntroduction" type="text" value="{{ old('introduction') }}" placeholder="{{ $profile->introduction }}">
            </div>
            <div class="form__error">
            @error('introduction')
                {{ $message }}
            @enderror
            </div>

            <div class="update__button-outer">
                <button class="update__button" type="submit">
                    更新する
                </button>
            </div>
            @if (Auth::check())
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            @endif
        </form>
    </div>
</div>
<script>
    async function fetchAddress() {
        const postcode = document.getElementById('postcode').value;
        if (postcode) {
            try {
                const response = await fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${postcode}`);
                const data = await response.json();
                if (data.results) {
                    const address = `${data.results[0].address1} ${data.results[0].address2} ${data.results[0].address3}`;
                    document.getElementById('address').value = address;
                } else {
                    alert('住所が見つかりませんでした。郵便番号を確認してください。');
                }
            } catch (error) {
                console.error('Error fetching address:', error);
                alert('住所の取得に失敗しました。再度お試しください。');
            }
        }
    }
</script>
@endsection