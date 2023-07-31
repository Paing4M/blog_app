@push('styles')
  <style>
    .comment_container::-webkit-scrollbar {
      display: none;
    }

    .comment_container {
      scrollbar-width: none;
    }
  </style>
@endpush


<div class="col-lg-9 col-md-12">
  <div class="mb-5 border-top mt-4 pt-5">
    <h3 class="mb-4">Comments</h3>

    <div class="comment_container" style="max-height: 600px;overflow-y: scroll">
      @forelse ($comments as $item)
        <div class="media d-block d-sm-flex mb-4 pb-4">
          <a class="d-inline-block mr-2 mb-3 mb-md-0" href="#">
            <img style="width: 50px; height: 50px;object-fit: cover;"
              src={{ $item->user->profile ? '/storage/profile_img/' . $item->user->profile : '/storage/profile_img/profile_default.png' }}
              class="mr-3 rounded-circle" alt="">
          </a>
          <div class="media-body">
            <a href="#" class="h4 d-inline-block mb-3">{{ $item->user->name }}</a>

            <p>{{ $item->comment }}</p>

            <span class="text-black-800 mr-3 font-weight-600">{{ $item->created_at->format('M d, Y') }} at
              {{ $item->created_at->format('g:i a') }}</span>

          </div>
        </div>
      @empty
        <p class="text-warning">No comment.</p>
      @endforelse
    </div>



  </div>

  <div>
    <h3 class="mb-4">Leave a Reply</h3>
    <form method="POST" wire:submit.prevent='addComment'">
      <div class="row">
        <input wire:model='post_id' type="hidden" value="{{ $post_id }}">
        <div class="form-group col-md-12">
          <textarea wire:model='comment' class="form-control shadow-none" name="comment" rows="7" required=""></textarea>
        </div>
      </div>
      <button class="btn btn-primary" type="submit">Comment Now</button>
    </form>
  </div>
</div>
