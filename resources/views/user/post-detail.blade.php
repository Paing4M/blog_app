@extends('user.layouts.profile-layout')
@section('content')
  <section class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class=" col-lg-9   mb-5 mb-lg-0">
          <article>

            <div class="mb-2">
              <img src={{ '/storage/images/' . $post->image }} class="card-img" alt="post-thumb"
                style="width: 825px;height:415px;object-fit:cover;">
            </div>

            <h1 class="h2">{{ $post->title }}</h1>
            <ul class="card-meta my-3 list-inline">
              <li class="list-inline-item">
                <a href="" class="card-meta-author">
                  <img
                    src="{{ $post->user->profile ? '/storage/profile_img/' . $post->user->profile : '/storage/profile_img/profile_default.png' }}">
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
            <div class="content">
              <p>
                {{ $post->content }}
              </p>

            </div>
          </article>

        </div>

        @livewire('comments', ['post_id' => $post->id])

      </div>
    </div>
  </section>
@endsection
