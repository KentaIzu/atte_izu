@extends('layouts.parent')

<style>
    body {
        margin: 0;
        padding: 0;
    }
    nav {
        display: flex;
    }
    .logo h1 {
        margin: 0px;
        padding: 10px 0;
    }
    ul {
        display: flex;
        justify-content: flex-end;
        list-style: none;
        align-items: center;
    }
    li {
        padding-left: 3%;
    }
    li a {
        text-decoration: none;
        color: black;
        font-weight: bold;
    }
    .content {
        width: 100%;
        height: 82%;
        background-color: #f2f2f2;
        text-align: center;
    }
    table {
        margin: 0 auto;
    }
    .login_content {
        width: 100%;
        padding: 40px 0;
    }
    .login_title h1 {
        font-size: 22px;
    }
    .content_form input {
        width: 350px;
        height: 40px;
        margin-bottom: 25px;
        border-radius: 5px;
        background-color: #f2f2f2;
        border: 2px solid #757575;
        padding-left: 10px;
    }
    .login_submit input {
        width: 350px;
        height: 40px;
        color: white;
        background-color: #214be0;
        border: none;
        border-radius: 5px;
    }
    .register_button p {
        color: #757575;
        padding-top: 10px;
    }
    .register_button a {
        text-decoration: none;
        color: #214be0;
        font-weight: bold;
    }
</style>

@section('header')
<nav>
    <div class="logo">
        <h1>Atte</h1>
    </div>
</nav>
@endsection

@section('content')
<div class="content">
    <div class="login_content">
        <div class="login_title">
            <h1>ログイン</h1>
        </div>
        <div class="content_form" :errors="$errors">
            <form method="POST" action="/login">
            @csrf

                <table>
                    <tr>
                        <th>
                            <input id="email" type="email" name="email" placeholder="メールアドレス" :value="old('email')" required autofocus />
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <input id="password" type="password" name="password" placeholder="パスワード" :value="old('password')" required autocomplete="current-password" />
                        </th>
                    </tr>
                </table>

                <div class="login_submit">
                    <input type="submit" value="{{ __('ログイン') }}">
                </div>

                <div class="register_button">
                    <p>アカウントをお持ちでない方はこちら</p>
                    <a href="/register">会員登録</a>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('footer')
<small>Atte,inc</small>
</div>
@endsection