@extends('layouts.sidebar')

@section('content')
<div class="vh-100 border">
  <div class="top_area w-75 m-auto pt-5">
    <div class = "title_seat mb-3">
    <p class = "title_text"><span>{{ $user->over_name }}</span><span>{{ $user->under_name }}さんのプロフィール</span></p>
</div>
    <div class="user_status p-3">
      <p class="user_status_text">名前 : <span>{{ $user->over_name }}</span><span class="ml-1">{{ $user->under_name }}</span></p>
      <p class="user_status_text">カナ : <span>{{ $user->over_name_kana }}</span><span class="ml-1">{{ $user->under_name_kana }}</span></p>
      <p class="user_status_text">性別 : @if($user->sex == 1)<span>男</span>@else<span>女</span>@endif</p>
      <p class="user_status_text">生年月日 : <span>{{ $user->birth_day }}</span></p>
      @if($user->role == 4)
      <div class="user_status_text">選択科目 :
        @foreach($user->subjects as $subject)
        <span>{{ $subject->subject }}</span>
        @endforeach
      </div>
      <div class="">
        @can('admin')
        <span class="subject_edit_btn">選択科目の編集</span>
        <div class="subject_inner">
          <form action="{{ route('user.edit') }}" method="post">
            @foreach($subject_lists as $subject_list)
            <div>
              <label>{{ $subject_list->subject }}</label>
              <input type="checkbox" name="subjects[]" value="{{ $subject_list->id }}">
            </div>
            @endforeach
            <input type="submit" value="編集" class="btn btn-primary">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            {{ csrf_field() }}
          </form>
        </div>
         @endif
        @endcan
      </div>
    </div>
  </div>
</div>

@endsection