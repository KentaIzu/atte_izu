@extends('layouts.parent')
<style>
  .content {
    width: 100%;
    background-color: #F5F5F5;
    text-align: center;
    flex-grow: 1;
  }
  .attendance-date {
    padding-top: 10px;
    display: flex;
    justify-content: center;
    width: 100%;
  }
  .attendance-date p {
    font-size: 20px;
    margin-top: 20px;
  }
  .attendance-date input {
    text-align: center;
    margin: 20px 40px;
    padding: 5px 10px;
    background-color: white;
    border: 1px solid blue;
    color: blue;
  }
  table {
    width: 90%;
    margin: 0 auto;
    padding: 10px 0;
    border-collapse: collapse;
    text-align: center;
    margin-bottom: 30px;
  }
  .attendance_table th {
    padding: 20px 0;
    border-top: 1px solid #9E9E9E;
    font-size: 16px;
  }
  table td {
    padding: 20px 0;
    border-top: 1px solid #9E9E9E;
    text-align: center;
    font-size: 14px;
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
<div class="attendance-date">
  <form action="/attendance/{num}" method="POST">
    @csrf
    <input type="hidden" class="form-control" id="today" name="today" value={{ $today }}>
    <input type="hidden" class="flg" name="dayflg" value="back">
    <input type="submit" name="" value="<" class="day-list" id="back_btn">
  </form>
  </form>
  <p>{{$today}}</p>
  <form action=" /attendance/{num}" method="POST">
    @csrf
    <input type="hidden" class="form-control" id="today" name="today" value={{ $today }}>
    <input type="hidden" class="flg" name="dayflg" value="next">
    <input type="submit" name="" value=">" class="day-list" id="next_btn">
  </form>
</div>
<div class="attendance-table">
  <table>
    <tr>
      <th>名前</th>
      <th>勤務開始</th>
      <th>勤務終了</th>
      <th>休憩時間</th>
      <th>勤務時間</th>
    </tr>
    @foreach($items as $item)
    <tr>
      <td>{{$item->user->name}}</td>
      <td>{{$item->start_time}}</td>
      <td>{{$item->end_time}}</td>
      <td>{{ $item->getRest() }}</td>
      <td>{{ $item->attendanceTime() }}</td>
    </tr>
    @endforeach
  </table>
  <div class="d-flex justify-content-center">
    {{ $items->links()}}
  </div>
</div>
@endsection
@section('footer')
<small>Atte,inc</small>
@endsection