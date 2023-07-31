@php
  use Illuminate\Support\Carbon;
@endphp


<div class="pb-3">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Posts</h1>
    <button class="btn btn-primary button-success" data-bs-toggle="modal" data-bs-target="#postingModal">Add Post</button>
  </div>

  <div class="mb-1">
    <div class="row">
      <div class="col-md-3 mt-2 mt-md-0">
        <select wire:model='postBy' class="form-select" aria-label="Default select example">
          <option value="">Post By (all)</option>
          @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-7 mt-2 mt-md-0">
        <div class="input-group">
          <input wire:model.debounce.300ms="search" type="text" class="form-control bg-light small"
            placeholder="Search..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="col-md-2 mt-2 mt-md-0">
        <select wire:model='categoryBy' class="form-select" aria-label="Default select example">
          <option value="">All Category</option>
          @foreach ($categories as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  <hr>



  <div class="container">
    <div class="row">
      @forelse ($posts as $post)
        <div style="max-height: 500px;overflow: hidden;" class="col-sm-12 col-md-6 col-lg-3 mt-2">
          <div style="height: 100%" class="card">
            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
              <img style="width: 100%; height: 200px; object-fit: cover"
                src="http://localhost:8000/storage/images/{{ $post->image }}" class="img-fluid">
              <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </a>
            </div>
            <div class="card-body">
              <h5 class="card-title flex align-items-center justify-content-between font-weight-bold">
                {{ $post->title }}
                <span style="color: rgba(0, 0, 0, .5);font-size: 12px;font-weight: normal"
                  class="ms-1">{{ Carbon::parse($post->created_at)->diffForHumans() }}</span>
              </h5>
              <p class="card-text">
                {{ stringLimit($post->content) }}
              </p>
            </div>
            <div class="card-footer d-flex justify-content-between">
              <button wire:click='editPost({{ $post->id }})' class="btn btn-sm btn-primary">Edit</button>
              <button wire:click.prevent="deletePost({{ $post->id }})" class="btn btn-sm btn-danger">Delete</button>
            </div>
          </div>
        </div>



      @empty
        <p class="text-center text-danger ">No posts found!</p>
      @endforelse


      <div class="mt-3">
        {{ $posts->links() }}
      </div>

    </div>
  </div>

  @php
    use App\Models\Post;
  @endphp

  @if ($delete_id)
    {{-- delete modal --}}
    <div wire:ignore class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
      aria-hidden="true">
      <div style="max-width: 300px" class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="categoryModalLabel">
              Delete Post
            </h1>
            <button id="closeDeleteModal" type="button" class="btn-close" data-bs-dismiss="modal"
              aria-label="Close"></button>
          </div>

          <div class="modal-body">
            Are you sure you want to delete this
            <span style="font-weight: bolder">{{ Post::find($delete_id)->title }}</span> post?
          </div>
          <div class="modal-footer mt-3 justify-content-between">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">No</button>
            <button wire:click='deleteConfirm' type="button" class="btn btn-sm btn-primary">Yes</button>
          </div>
        </div>
      </div>
    </div>
  @endif

  {{-- modal --}}
  <div wire:ignore.self class="modal modal-blur fade" id="postingModal" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop='static' data-bs-keyboard='false'>
    <form @if ($edit_id) wire:submit.prevent='updatePost' @else wire:submit.prevent='addPost' @endif
      action="" method="POST" enctype="multipart/form-data">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="postingModalLabel">
              @if ($edit_id)
                Update Post
              @else
                Add Post
              @endif
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="mb-3 col-6">
                <label class="form-label">Title</label>
                <input type="text" wire:model='title' class="form-control">
                @error('title')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="mb-3 col-6">
                <label class="form-label">Category</label>
                <select wire:model='category' class="form-select" aria-label="Default select example">
                  <option selected>--Select Category--</option>
                  @foreach ($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach

                </select>

                @error('category')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="mb-3 row">
              <div class="col-9">
                <label class="form-label">Image</label>
                <input id="imgInput" wire:model='image' class="form-control" type="file">
              </div>

              @if ($image || $tempImg)
                <div class="col-3">
                  <img style="width: 100px; height: 80px; object-fit: cover"
                    src="{{ $image ? $image->temporaryUrl() : asset('storage/images/' . $tempImg) }}" alt=""
                    class="" id="previewImg">
                </div>
              @endif
              @error('image')
                <span class="text-danger block col-12">{{ $message }}</span>
              @enderror

            </div>


            <div class="mb-3">
              <label for="">Content</label>
              <textarea wire:model='content' class="form-control" name="" id="" style="height: 200px"
                cols="20" rows="10"></textarea>
              @error('content')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>



          <div class="modal-footer">
            <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">
              @if ($edit_id)
                Update Post
              @else
                Add Post
              @endif
            </button>
          </div>
    </form>
  </div>


</div>


@push('scripts')
  <script>
    $(document).ready(function() {


      window.addEventListener('success', e => {
        toastr.success(e.detail.message);
      })

      window.addEventListener('closeModal', e => {
        //    $('#postingModal').modal('hide')
        //    $('body').removeClass('modal-open');
        //  $('.modal-backdrop').remove();
        $('.closeModal').click();

        // delete modal
        $('#closeDeleteModal').click();
        $('#deleteModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        $("body").css("overflow", "");
        $("body").css("padding", "");
      })


      window.addEventListener('openModal', function() {
        $('#postingModal').modal('show')
      })


      // window.addEventListener('closeDeleteModal', function() {
      //   $('#closeDeleteModal').click();
      //   $('#deleteModal').modal('hide');
      //   $('body').removeClass('modal-open');
      //   $('.modal-backdrop').remove();
      // });


      window.addEventListener('openDeleteModal', e => {
        $('#deleteModal').modal('show');
      });


      $('#postingModal').on('hidden.bs.modal', function() {
        Livewire.emit('resetModalForm')
      })

      $('#deleteModal').on('hidden.bs.modal', function() {
        $('#closeDeleteModal').click();
      })


    });
  </script>
@endpush
