@extends('layouts.sidebar')
@section('content')
<div class="w-100 vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-100 vh-100 border p-5">
  <div class = "title_seat mb-3 ">
    <p class="title_text">スクール枠登録</p>
</div>
    {!! $calendar->render() !!}
    <div class="adjust-table-btn calendar-register text-right">
      <input type="submit" class="btn btn-primary calendar-btn" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  </div>
</div>
@endsection