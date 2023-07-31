<section>
  <header>
    <h2 class="text-lg font-medium text-gray-900">
      {{ __('Profile picture') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
      {{ __("Update your account's profile picture.") }}
    </p>
  </header>

  <form method="post" action="{{ route('admin.profile.upload') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
    @csrf
    <div>
      <div class="mb-1">
        <input id="imgInput" name="profile" class="form-control" type="file" id="formFile">
      </div>

      <div>
        <img id="imagePreview"
          src="{{ Auth::user()->profile ? asset('storage/profile_img/' . Auth::user()->profile) : asset('storage/profile_img/profile_default.png') }}"
          alt="" style="width: 200px ; height: 200px; object-fit: cover">
      </div>

    </div>

    <div class="flex items-center gap-4">
      <x-primary-button>{{ __('Save') }}</x-primary-button>
    </div>
  </form>
</section>


<script>
  const imgInput = document.getElementById('imgInput')
  imgInput.addEventListener('change', function(e) {
    let reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('imagePreview').src = e.target.result;
    }
    reader.readAsDataURL(e.target.files[0]);
  })
</script>
