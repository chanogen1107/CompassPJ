@extends('layouts.sidebar')

@section('content')
<div class = "title_seat mb-3 mt-5">
    <p class="title_text">スクール予約確認</p>
</div>
<div class="w-75 mr-auto ml-auto " style="border-radius:5px; background:#FFF;">

<div class="w-100 p-5">
    <p class = "text-center">{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  </div>
</div>
@endsection