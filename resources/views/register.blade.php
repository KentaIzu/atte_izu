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

    .register_content {
        width: 100%;
        padding: 25px 0;
    }

    .register_title h1 {
        font-size: 22px;
        text-align: center;
    }

    .content_form input {
        width: 350px;
        height: 40px;
        margin-bottom: 25px;
        border-radius: 5px;
        background-color: #f2f2f2;
        border: 2px solid #909090;
        padding-left: 10px;
    }

    table {
        margin: 0 auto;
    }

    .register_submit input {
        width: 350px;
        height: 40px;
        color: white;
        background-color: #214be0;
        border: none;
        border-radius: 5px;
    }

    .login_button p {
        color: #757575;
    }

    .login_button a {
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
    </div>
@section('content')
    <div class="content">
        <div class="register_content">
            <div class="register_title">
                <h1>会員登録</h1>
            </div>

            <div class="content_form" :errors="$errors">

                <form method="POST" action="/register">
                    @csrf
                    <table>
                        <tr>
                            <td>
                                <input id="name" type="text" name="name" placeholder="名前" :value="old('名前')" required
                                    autofocus />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input id="email" type="email" name="email" placeholder="メールアドレス" :value="old('email')"
                                    required />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input id="password" type="password" name="password" placeholder="パスワード" required
                                    autocomplete="new-password" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input id="password_confirmation" type="password" placeholder="確認用パスワード"
                                    name="password_confirmation" required />
                            </td>
                        </tr>
                    </table>
                    <div class="register_submit">
                        <input type="submit" value="{{ __('会員登録') }}">
                    </div>

                    <div class="login_button">
                        <p>アカウントをお持ちの方はこちら</p>
                        <a href="/login">ログイン</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <small>Atte,inc</small>
@endsection
