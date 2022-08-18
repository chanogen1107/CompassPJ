@extends('layouts.sidebar')

@section('content')
<div class="search_content w-100  d-flex">
  <div class = "search-view w-75 mt-5">
<div class = "title_seat mb-3">
<p class = "title_text">ユーザー検索</p>
</div>
  <div class="reserve_users_area">

    @foreach($users as $user)
    <div class="border one_person m-2 p-2">
      <div>
        <span class = "sub-text">ID : </span><span>{{ $user->id }}</span>
      </div>
      <div><span class = "sub-text">名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span>{{ $user->over_name }}</span>
          <span>{{ $user->under_name }}</span>
        </a>
      </div>
      <div class="border-bottom">
        <span class = "sub-text">カナ : </span>
        <span>({{ $user->over_name_kana }}</span>
        <span>{{ $user->under_name_kana }})</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span class = "sub-text">性別 : </span><span>男</span>
        @else
        <span class = "sub-text">性別 : </span><span>女</span>
        @endif
      </div>
      <div>
        <span class = "sub-text">生年月日 : </span><span>{{ $user->birth_day }}</span>
      </div>
      <div>
        @if($user->role == 1)
        <span class = "sub-text">権限 : </span><span>教師(国語)</span>
        @elseif($user->role == 2)
        <span class = "sub-text">権限 : </span><span>教師(数学)</span>
        @elseif($user->role == 3)
        <span class = "sub-text">権限 : </span><span>講師(英語)</span>
        @else
        <span class = "sub-text">権限 : </span><span>生徒</span>
        @endif
      </div>
      <div>
        @if($user->role == 4)
        <span class = "sub-text">選択科目 :</span>
        @foreach($user->subjects as $subject)
        <span>{{ $subject->subject }}</span>
        @endforeach
        @endif
      </div>
    </div>
    @endforeach
  </div>
</div>
  <div class="search_area w-25 mt-5 border p-4">
    <div class="">
      <div>
        <input type="text" class="free_word btn-block box-design mb-3" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>
      <div>
        <lavel>カテゴリ</lavel>
        <select class="box-design mb-3" form="userSearchRequest" name="category">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <div>
        <label>並び替え</label>
        <select class="box-design" name="updown" form="userSearchRequest">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>
      <div class="">
        <p class="m-0 search_conditions mt-3 mb-3"><span>検索条件の追加▼</span></p>
        <div class="search_conditions_inner">
          <div>
            <label>性別</label>
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
          </div>
          <div>
            <label>権限</label>
            <select name="role" form="userSearchRequest" class="engineer">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
          <div class="selected_engineer">
            <label>選択科目</label>
            @foreach($subjects as $subject)
            <div>
            <span>{{$subject->subject}}</span><input type = "checkbox" name="subjects" form="userSearchRequest" value="{{$subject->id}}">
</div>
            @endforeach
          </div>
        </div>
      </div>
      <div class = "user-search-btn mt-3">
      <div class = searching-btn>
        <input type="submit" class = "btn btn-sm" name="search_btn" value="検索" form="userSearchRequest">
      </div>
      <div class = reset-btn>
        <input type="reset" class = "btn btn-sm" value="リセット" form="userSearchRequest">
      </div>
</div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
@endsection