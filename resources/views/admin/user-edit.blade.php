@extends('admin.layouts.layout')
@section('content')
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
    </div>

    <div class="container">

      <form method="POST" action="{{ route('admin.user-update', $user->id) }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input name="name" type="text" value="{{ $user->name }}"
            class="form-control @error('name')
             is-invalid
          @enderror">
          @error('name')
            <sapn class="text-danger">{{ $message }}</sapn>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input name="email" value="{{ $user->email }}" type="text" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Role</label>
          <select name="role" class="form-control">
            <option {{ $user->role === 'admin' ? 'selected' : '' }} value="admin">admin</option>
            <option {{ $user->role === 'user' ? 'selected' : '' }} value="user">user</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
      </form>


    </div>

  </div>
@endsection

@push('scripts')
  <script></script>
@endpush
