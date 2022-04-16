@extends('layouts.parent')
<style>
  .content {
    justify-content: center;
    width: 100%;
    background-color: #F5F5F5;
    text-align: center;
    flex-grow: 1;
  }
  .user-name-ttl h2 {
    padding-top: 25px;
  }
  .user-name ul {
    width: 50%;
    margin: 0 auto;
    list-style: none;
    padding-top: 10px;
    margin-bottom: 30px;
  }
  .user-name li {
    border-top: 2px solid #2196F3;
    border-left: 2px solid #2196F3;
    border-right: 2px solid #2196F3;
    padding: 7px 0;
  }
  .user-name li:last-child {
    border-bottom: 2px solid #2196F3;
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
    <li><a href="/logout">ログアウト</a></li>
  </ul>
</nav>
@endsection

@section('content')
<div class="user-name">
  <div class="user-name-ttl">
    <h2>ユーザー一覧</h2>
  </div>
  <ul>
    @foreach($items as $item)
    <li>{{ $item->name }}</li>
    @endforeach
  </ul>
</div>
<div class="d-flex justify-content-center">
  {{ $items->links('pagination.bootstrap-4') }}
</div>
@endsection
@section('footer')
<small>Atte,inc</small>
@endsection