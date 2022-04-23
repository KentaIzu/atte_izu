@extends('layouts.parent')
<style>
    .content {
        width: 100%;
        height: 82%;
        background-color: #F5F5F5;
        text-align: center;
    }

    .user-name h2 {
        font-size: 22px;
        margin: 30px 0 60px 0;
        font-weight: bold;
    }

    .index-content {
        width: 100%;
        padding: 30px 0;
    }

    .attendance-button {
        display: flex;
    }

    .attendance-button table {
        margin: 0 auto;
        padding: 20px 0;
    }

    .attendance-button td {
        padding: 10px 20px;
    }

    .attendance-button button {
        border: none;
        padding: 60px 120px;
        background-color: white;
    }

    @media screen and (max-width: 480px) {
        .attendance-button button {
            border: none;
            padding: 40px 100px;
            background-color: white;
        }

        .attendance-button th,
        td {
            display: block;
        }

        .user-name h2 {
            font-size: 18px;
            margin: 30px 0 30px 0;
            font-weight: bold;
        }
    }

</style>
@section('header')
    <nav>
        <div class="logo">
            <h1>Atte</h1>
        </div>
        <ul>
            <li><a href="/">ホーム</a></li>
            <li><a href="/attendance/{num}">日付一覧</a></li>
            <li><a href="/userlist">ユーザー一覧</a></li>
            <li><a href="/logout">ログアウト</a></li>
        </ul>
    </nav>
@endsection

@section('content')
    <div class="index-content">
        <div class="user-name">
            <h2>{{ Auth::user()->name }}さんお疲れ様です!</h2>
            @if (session('error'))
                <p class="user-error-start">{{ session('error') }}</p>
            @endif
        </div>
        <div class="attendance-button">
            <table>
                <tr>
                    <td>
                        <form action="/attendance/start" method="POST" name="btn_start">
                            @csrf
                            @if (Session::has('start_time') || Session::has('rest_start') || Session::has('rest_end') || Session::has('end_time'))
                                <button type="submit" id="btn_start" disabled>勤務開始</button>
                            @else
                            @csrf
                            @method('POST')
                                <button type="submit" id="btn_start">勤務開始</button>
                            @endif
                        </form>
                    </td>
                    <td>
                        <form action="/attendance/end" method="POST" name="btn_end">
                            @csrf
                            @if (Session::has('rest_end'))
                                <button type="submit" id="btn_end">勤怠終了</button>
                            @elseif(!Session::has('start_time'))
                                <button type="submit" id="btn_end" disabled>勤怠終了</button>
                            @else
                            @csrf
                            @method('POST')
                                <button type="submit" id="btn_end">勤怠終了</button>
                            @endif
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form action="/rest/start" method="POST">
                            @csrf
                            @if (Session::has('rest_end'))
                                <button type="submit" id="btn_rest_start">休憩開始</button>
                            @elseif(!Session::has('start_time') || Session::has('rest_start'))
                                <button type="submit" id="btn_rest_start" disabled>休憩開始</button>
                            @else
                            @csrf
                            @method('POST')
                                <button type="submit" id="btn_rest_start">休憩開始</button>
                            @endif
                        </form>
                    </td>
                    <td>
                        <form action="/rest/end" method="POST">
                            @csrf
                            @if (!Session::has('start_time') && !Session::has('rest_start'))
                                <button type="submit" id="btn_rest_end" disabled>休憩終了</button>
                            @elseif(Session::has('start_time'))
                                <button type="submit" id="btn_rest_end" disabled>休憩終了</button>
                            @else
                            @csrf
                            @method('POST')
                                <button type="submit" id="btn_rest_end">休憩終了</button>
                            @endif
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection

@section('footer')
    <small>Atte,inc</small>
@endsection
