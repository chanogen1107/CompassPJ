@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-50 m-auto h-75">
    <div class = "title_seat mb-3">
    <p class="title_text"><span>{{$date}}日</span><span class="ml-3">{{$part}}部</span></p>
</div>

   <div class="h-75" style = "border-radius:5px; background:#FFF;">
   <div class = "p-3">
      <table class="ml-auto mr-auto" >
      <tr class="text-center">
          <th class="detail_size">ID</th>
          <th class="detail_size">名前</th>
          <th class="detail_size">場所</th>
        </tr>
      @foreach($reservePersons -> users as $reservePerson)
        <tr class="text-center">
          <td class="w-25">{{$reservePerson -> id}}</td>
          <td class="w-25">{{$reservePerson -> over_name}}{{$reservePerson -> under_name}} </td>
          <td class="w-25">リモ{{$part}}部 </td>
        </tr>
        @endforeach
      </table>
      </div>
    </div>
  </div>
</div>
@endsection