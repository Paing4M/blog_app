<div>
  <div class="mb-3 mx-auto">
    <div class="row">
      <div class="col-md-2">
        <select wire:model="role" class="form-select" aria-label="Default select example">
          <option value="">All</option>
          <option value="user">User</option>
          <option value="admin">Admin</option>
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


      <div class="col-md-3 mt-2 mt-md-0">
        <select wire:model="order" class="form-select" aria-label="Default select example">
          <option value="asc">Asc</option>
          <option value="desc">Desc</option>
        </select>
      </div>
    </div>
  </div>

  <hr>

  <div class="container">
    <table class="table  table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col">#No</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($users as $key => $user)
          <tr class="table-row">
            <th scope="row">
              {{ $key + 1 }}
            </th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
              <div>
                <a href="{{ route('admin.user-edit', $user->id) }}" class="btn btn-sm btn-success"><i
                    class="fa-regular fa-pen-to-square"></i>
                  Edit</a>
                <a href="{{ route('admin.user-delete', $user->id) }}" class="btn btn-sm btn-danger"><i
                    class="fa-regular fa-trash-can"></i> Delete</a>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-danger">
              No user found!
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    {{ $users->links() }}

  </div>
</div>
