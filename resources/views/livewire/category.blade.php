<div>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Categories</h1>
      <btn data-bs-toggle="modal" data-bs-target="#categoryModal" class="btn btn-sm btn-primary ">
        Add
        Category</btn>
    </div>


    <div class="container">
      <table class="table  table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">#No</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($categories as $key => $category)
            <tr class="table-row">
              <th scope="row">
                {{ $loop->iteration }}
              </th>
              <td>{{ $category->name }}</td>
              <td>
                <div>
                  <button wire:click="edit({{ $category->id }})" class="btn btn-sm btn-success"><i
                      class="fa-regular fa-pen-to-square"></i>
                    Edit</button>
                  <button wire:click="delete({{ $category->id }})" class="btn btn-sm btn-danger">
                    <i class="fa-regular fa-trash-can"></i> Delete
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-danger">
                No category found!
              </td>
            </tr>
          @endforelse

        </tbody>
      </table>
      {{ $categories->links('livewire::bootstrap') }}



    </div>
  </div>

  <!--  Category Modal -->
  <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop='static'
    data-bs-keyboard='false' id="categoryModal">
    <div class="modal-dialog ">
      <form
        @if ($edit_id) wire:submit.prevent='update'
 @else wire:submit.prevent='addCategory' @endif
        id="addCategoryForm" method="POST">
        @csrf
        <div style="width: 100%" class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="categoryModalLabel">
              @if ($edit_id)
                Update Category
              @else
                Add Category
              @endif
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="mb-3">
              <label class="form-label">Name</label>
              <input wire:model='name' name="name" type="text" value="{{ old('name') }}"
                class="form-control name @error('name')
                is-invalid
              @enderror">
              @error('name')
                <span class="text-danger nameErr">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="modal-footer">
            <button id="closeModal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">
              @if ($edit_id)
                Update Category
              @else
                Add Category
              @endif
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  @php
    use App\Models\Category;
  @endphp

  @if ($delete_id)
    {{-- delete modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" data-bs-backdrop='static'
      data-bs-keyboard='false' aria-hidden="true">
      <div style="max-width: 300px" class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="categoryModalLabel">
              Delete Category
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            Are you sure you want to delete this
            <span style="font-weight: bolder">{{ Category::find($delete_id)->name }}</span> category?

          </div>
          <div class="modal-footer mt-3 justify-content-between">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">No</button>
            <button wire:click='deleteConfirm()' type="button" class="btn btn-sm btn-primary">Yes</button>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>

@push('scripts')
  <script>
    window.addEventListener('success', e => {
      toastr.success(e.detail.message);
    })

    window.addEventListener('error', e => {
      toastr.error(e.detail.message);
    })

    window.addEventListener('openDeleteModal', e => {
      $('#deleteModal').modal('show');
    })

    window.addEventListener('closeModal', function() {
      $('#categoryModal').modal('hide')
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
    })

    window.addEventListener('closeModalDelete', function() {
      $('#deleteModal').modal('hide')
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
    })

    window.addEventListener('showModal', function() {
      $('#categoryModal').modal('show')
    })

    $('#categoryModal').on('hidden.bs.modal', function() {
      Livewire.emit('resetModalForm')
    })
  </script>
@endpush
