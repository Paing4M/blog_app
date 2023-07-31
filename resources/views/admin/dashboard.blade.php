@extends('admin.layouts.layout')
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                All Account</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $all->count() }} <span
                  class="text-blue-400 text-sm">accounts</span></div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Admin</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $admins->count() }} <span
                  class="text-blue-400 text-sm">admins</span></div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                User</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $normalUser->count() }} <span
                  class="text-blue-400 text-sm">users</span></div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                All Category</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $category->count() }} <span
                  class="text-blue-400 text-sm">categories</span></div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Category With Post</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categoryWithPost->count() }} <span
                  class="text-blue-400 text-sm">posts used category</span></div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Post</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $post->count() }} <span
                  class="text-blue-400 text-sm">posts</span></div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-newspaper fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
