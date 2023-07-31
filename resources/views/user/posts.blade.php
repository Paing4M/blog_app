@extends('user.layouts.profile-layout')
@push('styles')
  <style>
    .mt-5 {
      margin-top: 5rem;
    }
  </style>
@endpush
@section('content')
  <div class="mt-5">
    @livewire('user-post-list')
  </div>
@endsection
