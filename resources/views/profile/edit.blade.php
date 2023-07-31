 @extends('user.layouts.profile-layout')
 @push('styles')
 @endpush
 @section('content')
   <div class="py-5 px-4 ">
     <h3 class=" text-gray-800">Profile</h3>
     <div class="container">
       <div class="p-4 mb-3 sm:p-8 bg-white shadow-lg  sm:rounded-lg">
         <div class="container" style="max-width: 500px">
           @include('profile.partials.update-profile-information-form')
         </div>
       </div>

       <div class="p-4 mb-3 sm:p-8 bg-white shadow-lg sm:rounded-lg">
         <div class="container" style="max-width: 500px">
           @include('profile.partials.upload-profile')
         </div>
       </div>

       <div class="p-4 mb-3 sm:p-8 bg-white shadow-lg sm:rounded-lg">
         <div class="container" style="max-width: 500px">
           @include('profile.partials.update-password-form')
         </div>
       </div>

       {{-- <div class="p-4 mb-3 sm:p-8 bg-white shadow-lg sm:rounded-lg">
         <div class="container" style="max-width: 500px">
           @include('profile.partials.delete-user-form')
         </div>
       </div> --}}
     </div>
   </div>
 @endsection
 @push('scripts')
   @if (Session::has('success'))
     <script>
       toastr.success("{{ Session::get('success') }}")
     </script>
   @endif
 @endpush
