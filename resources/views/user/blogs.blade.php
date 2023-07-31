@extends('user.layouts.user-layout')
@section('content')
  <div class="col-lg-8  mb-5 mb-lg-0">
    <h2 class="h5 section-title">Posts</h2>

    <div class="row">
      @foreach ($posts as $post)
        <div class="col-lg-6 col-sm-6">
          <article class="card mb-4">
            <div class="post-slider">
              <img style="width: 100%;height:200px;object-fit:cover" src={{ "storage/images/$post->image" }}
                class="card-img-top" alt="post-thumb">
            </div>
            <div class="card-body">
              <h3 class="mb-3"><a class="post-title"
                  href="{{ route('posts-detail', $post->id) }}">{{ $post->title }}</a>
              </h3>
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
              <p>{{ stringLimit($post->content, 200) }}</p>
              <a href="{{ route('posts-detail', $post->id) }}" class="btn btn-outline-primary">Read More</a>
            </div>
          </article>
        </div>
      @endforeach

      <div class="mt-3">
        {{ $posts->links('pagination::bootstrap-5') }}
      </div>
    </div>

  </div>
@endsection
