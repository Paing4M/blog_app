@extends('admin.layouts.layout')
@push('styles')
@endpush
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profile</h1>
  </div>

  <div class="pb-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
          @include('admin.partials.update-profile-information-form')
        </div>
      </div>

      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
          @include('admin.partials.upload-profile')
        </div>
      </div>


      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
          @include('admin.partials.update-password-form')
        </div>
      </div>

      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
          @include('admin.partials.delete-user-form')
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  @if (Session::has('success'))
    <script>
      toastr.success("{{ Session::get('success') }}")
    </script>
  @endif
  @if (Session::has('error'))
    <script>
      toastr.error("{{ Session::get('error') }}")
    </script>
  @endif
@endpush
