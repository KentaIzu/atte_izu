@extends('layouts.parent')
<style>
  .content {
    width: 100%;
    background-color: #f2f2f2;
  }
  .user_name_list h2 {
    padding-top: 30px;
    text-align: center;
  }
  .user_name ul {
    width: 70%;
    font-size: 20px;
    margin: 0 auto;
    padding-top: 15px;
    margin-bottom: 30px;
  }
  .pagination {
    justify-content: center;
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
<div>
  <div class="user_name_list">
    <h2>ユーザー一覧</h2>
  </div>
  <ul>
    @foreach($items as $item)
    <li><a href="/userattendance/{num}">{{ $item->name }}</a></li>
    @endforeach
  </ul>
</div>
<div class="pagination">
  {{ $items->links('pagination.bootstrap-4') }}
</div>
@endsection
@section('footer')
<small>Atte,inc</small>
@endsection