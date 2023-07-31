@extends('admin.layouts.layout')
@section('content')
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Users</h1>
    </div>

    @livewire('user-table')
  </div>
@endsection
@push('scripts')
  <script>
    @if (Session::has('success'))
      toastr.success("{{ Session::get('success') }}");
    @endif
  </script>
@endpush
