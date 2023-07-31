@extends('user.layouts.profile-layout')
@section('content')
  <div class="mt-5">
    <div class="row">
      <h1 class="h2 mb-4">Showing Search Result: <mark>{{ $search }}</mark></h1>
      <div class="col-lg-9  mb-5 mb-lg-0">

        @forelse ($posts as $post)
          <article class="card my-4">
            <div class="post-slider slick-initialized slick-slider">

              <img src={{ '/storage/images/' . $post->image }} class="card-img-top slick-slide slick-current slick-active"
                alt="post-thumb" data-slick-index="0" aria-hidden="false" tabindex="0"
                style="width: 100%;height:450px;object-fit:cover">

            </div>

            <div class="card-body">
              <h3 class="mb-3"><a class="post-title"
                  href="{{ route('posts-detail', $post->id) }}">{{ $post->title }}</a></h3>
              <ul class="card-meta list-inline">
                <li class="list-inline-item">
                  <a href="" class="card-meta-author">
                    <img style="width: 40px ;height: 40px;border-radius: 50%;object-fit: cover"
                      src={{ $post->user->profile ? '/storage/profile_img/' . $post->user->profile : '/storage/profile_img/profile_default.png' }}>
                    <span>{{ $post->user->name }}</span>
                  </a>
                </li>
                <li class="list-inline-item">
                  <i class="ti-timer"></i>{{ readDuration($post->content, $post->title) }} Min To Read
                </li>
                <li class="list-inline-item">
                  <i class="ti-calendar"></i>{{ $post->created_at->format('d M, Y') }}
                </li>
                <li class="list-inline-item">
                  <ul class="card-meta-tag list-inline">
                    <li class="list-inline-item"><a
                        href="{{ route('category-show', $post->category->id) }}">{{ $post->category->name }}</a></li>
                  </ul>
                </li>
              </ul>
              <p>{{ stringLimit($post->content, 300) }}</p>
              <a href="{{ route('posts-detail', $post->id) }}" class="btn btn-outline-primary">Read More</a>
            </div>
          </article>
        @empty
          <p class="text-center text-danger">No Posts Found!.</p>
        @endforelse
        <div class="mt-2">
          {{ $posts->appends(request()->input())->links('pagination::bootstrap-5') }}

        </div>
      </div>

      <aside class="col-lg-3 sidebar-inner mt-4">
        <!-- categories -->
        <div class="widget widget-categories">
          <h4 class="widget-title"><span>Categories</span></h4>
          <ul class="list-unstyled widget-list">
            @foreach ($categories as $item)
              @php
                $category = \App\Models\Category::find($item->id);
              @endphp
              <li><a href="{{ route('category-show', $item->id) }}" class="d-flex">{{ $item->name }} <small
                    class="ml-auto">({{ count($category->posts) }})</small></a></li>
            @endforeach
          </ul>
        </div>



        <!-- Social -->
        <div class="widget">
          <h4 class="widget-title"><span>Social Links</span></h4>
          <ul class="list-inline widget-social">
            <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="ti-linkedin"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="ti-youtube"></i></a></li>
          </ul>
        </div>
      </aside>

    </div>
  </div>
@endsection
