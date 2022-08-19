@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 m-auto d-flex">
  <div class="post_view w-75 mt-5">
  <div class = "title_seat mb-3 ">
    <p class="title_text">投稿一覧</p>
</div>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
        <div class="cate-box">
        @foreach($post->SubCategory as $SubCategories)
          <p class="category_btn">{{$SubCategories->sub_category}}</p>
        @endforeach
        </div>
        </div>
        <div class = re-box>
              <i class="fa fa-comment"></i><span class="mr-5">{{ $post->postComments->count()}}</span>
              @if(Auth::user()->is_Like($post->id))
              <i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{$post->likes->count()}}</span>
              @else
              <i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{$post->likes->count()}}</span>
              @endif
          </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area w-25 mt-5">
    <div class=" m-4">
      <div class="btn btn-primary btn-lg btn-block mb-3"><a class = "post-text" href="{{ route('post.input') }}">投稿</a></div>
      <div class="mb-3 likemy-btn">
        <input type="text" class = "search-box" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <div class = "search-btn">
        <input type="submit" class = "btn btn-sm color-text" value="検索" form="postSearchRequest">
</div>
      </div>
      <div class = "likemy-btn d-flex">
        <div class = "like-btn">
      <input type="submit" name="like_posts" class="btn btn-sm btn-block like-btn color-text" value="いいねした投稿" form="postSearchRequest">
</div>
<div class = "my-post-btn">
      <input type="submit" name="my_posts" class="btn btn-sm btn-block color-text" value="自分の投稿" form="postSearchRequest">
      </div>
    </div>
      <ul >
        @foreach($categories as $category)
        <li class="main_categories mb-2 ml-3" category_id="{{ $category->id }}"><span>{{ $category->main_category }}▼<span></li>
        @foreach($category->subCategories as $sub_category)
        <li class = "category_num{{$sub_category->MainCategory->id}} category_box">
         <input type="submit"  name="category_word" class="category_btn ml-3"  value="{{ $sub_category->sub_category }}" value="{{ $sub_category->id }}" form="postSearchRequest">
        </li>
        <!-- <input type="submit" name="category_word" class="category_btn" value="{{ $sub_category->id }}" form="postSearchRequest" > -->
        <!-- <input type="submit" class="category_btn" name="category_word" category_id="{{ $category->id }}" value="{{ $sub_category->sub_category }}" form="postSearchRequest"> -->
        @endforeach
        @endforeach
      </ul>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
@endsection