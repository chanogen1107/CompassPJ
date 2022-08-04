@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-50 m-auto h-75">
    <p><span>{{$date}}日</span><span class="ml-3">{{$part}}部</span></p>
    <div class="h-75 border">
      <table class="">
      @foreach($reservePersons -> users as $reservePerson)
        <tr class="text-center">
          <th class="w-25">{{$reservePerson -> id}}</th>
          <th class="w-25">{{$reservePerson -> over_name}}{{$reservePerson -> under_name}} </th>
          <th class="w-25">リモ{{$part}}部 </th>
        </tr>
        @endforeach
        <tr class="text-center">
          <td class="w-25"></td>
          <td class="w-25"></td>
        </tr>
      </table>
    </div>
  </div>
</div>
@endsection