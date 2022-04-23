@extends('layouts.parent')
<style>
    .content {
        background-color: #f2f2f2
    }

    body {
        margin: 0;
        padding: 0;
    }

    p {
        text-align: center;
        font-size: 20px;
    }

</style>

@section('header')
    <nav>
        <div class="logo">
            <h1>Atte</h1>
        </div>
    </nav>
    </div>
@section('content')
    <p>ご入力頂いたメールアドレス宛に確認メールを送信しました。<br>
        記載の認証ボタンをクリックし、会員登録を完了させてください。</p>
@endsection
@section('footer')
    <small>Atte,inc</small>
@endsection
