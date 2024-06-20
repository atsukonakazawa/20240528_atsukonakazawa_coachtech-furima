@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="content__outer">
    <div class="content">
        <form action="{{ route('auth.store') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="register__box">
                <h2 class="title">
                    会員登録
                </h2>

                <div class="register__box-row">
                    <p class="register__box-p">
                        お名前 <span class="required">※必須</span>
                    </p>
                    <input class="register__box-input" name="name" value="{{ old('name') }}" type="text" placeholder="高地　哲子">
                </div>
                <div class="form__error">
                @error('name')
                    {{ $message }}
                @enderror
                </div>

                <div class="register__box-row">
                    <p class="register__box-p">
                        ユーザー名 <span class="required">※必須</span>
                    </p>
                    <input class="register__box-input" name="nickname" value="{{ old('nickname') }}" type="text" placeholder="こーち">
                    <p class="limit__p">
                        ※アプリ上で公開される名前となります
                    </p>
                </div>
                <div class="form__error">
                @error('nickname')
                    {{ $message }}
                @enderror
                </div>

                <div class="register__box-row">
                    <p class="register__box-p">
                        郵便番号(半角・数字・ハイフンなし) <span class="required">※必須</span>
                    </p>
                    <input class="register__box-input" id="postcode" name="postcode" value="{{ old('postcode') }}" type="text" placeholder="1231234" onblur="fetchAddress()">
                </div>
                <div class="form__error">
                @error('postcode')
                    {{ $message }}
                @enderror
                </div>

                <div class="register__box-row">
                    <p class="register__box-p">
                        住所(番地まで) <span class="required">※必須</span>
                    </p>
                    <input class="register__box-input" id="address" name="address" value="{{ old('address') }}" type="text" placeholder="東京都港区芝公園4-2-8">
                </div>
                <div class="form__error">
                @error('address')
                    {{ $message }}
                @enderror
                </div>

                <div class="register__box-row">
                    <p class="register__box-p">
                        建物名
                    </p>
                    <input class="register__box-input" name="building" value="{{ old('building') }}" type="text" placeholder="東京マンション333">
                </div>

                <div class="register__box-row">
                    <p class="register__box-p">
                        自己紹介文 <span class="required">※必須</span>
                    </p>
                    <textarea class="register__box-input" name="introduction" cols="30" rows="10" placeholder="利用を始めたばかりです。慣れない部分もありますが、よろしくお願いいたします。">{{ old('introduction') }}</textarea>
                    <p class="limit__p">
                        ※最大300文字まで
                    </p>
                </div>
                <div class="form__error">
                @error('introduction')
                    {{ $message }}
                @enderror
                </div>

                <div class="register__box-row">
                    <p class="register__box-p">
                        プロフィール画像 <span class="required">※必須</span>
                    </p>
                    <input class="register__box-input" type="file" id="img" name="img" value="{{ old('img') }}" >
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

                <div class="register__box-row">
                    <p class="register__box-p">
                        メールアドレス <span class="required">※必須</span>
                    </p>
                    <input class="register__box-input" type="email" name="email" value="{{ old('email') }}" placeholder="kouchi@example.com">
                </div>
                <div class="form__error">
                @error('email')
                    {{ $message }}
                @enderror
                </div>

                <div class="register__box-row">
                    <p class="register__box-p">
                        パスワード <span class="required">※必須</span>
                    </p>
                    <input class="register__box-input" name="password" type="password" value="{{ old('password') }}" placeholder="kouchi123（8文字以上）">
                    <p class="limit__p">
                        ※8文字以上
                    </p>
                </div>
                <div class="form__error">
                @error('password')
                    {{ $message }}
                @enderror
                </div>

                <div class="register__box-row">
                    <p class="register__box-p">
                        パスワード(確認用) <span class="required">※必須</span>
                    </p>
                    <input class="register__box-input" name="password_confirmation" type="password">
                </div>

                <div class="register-button__outer">
                    <button class="register-button">
                        登録
                    </button>
                </div>
            </div>
        </form>
        <div class="to__login">
            <a href="/login">
                ログインはこちら
            </a>
        </div>
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
