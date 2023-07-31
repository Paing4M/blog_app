<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">

<head>
  <meta charset="utf-8">
  <title>My Blog</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="This is meta description">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Hugo 0.74.3" />

  <!-- theme meta -->
  <meta name="theme-name" content="reader" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- plugins -->
  <link rel="stylesheet" href="{{ asset('assets/front/plugins/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/front/plugins/themify-icons/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/front/plugins/themify-icons/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/front/plugins/slick/slick.css') }}">

  <!-- Main Stylesheet -->
  @livewireStyles()
  @stack('styles')
  {{-- toastr --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css"
    integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  {{-- fontawesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}" media="screen">
  <meta property="og:title" content="Reader | Hugo Personal Blog Template" />
  <meta property="og:description" content="This is meta description" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="" />
  <meta property="og:updated_time" content="2020-03-15T15:40:24+06:00" />
</head>

<body>
  <!-- navigation -->
  <header class="navigation fixed-top">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-white">
        <ul class="navbar-nav">
          <li class="nav-item"><a href="/" style="font-size: 1.6rem" class="nav-link">My Blog</a></li>
        </ul>
        <div class="collapse navbar-collapse text-center order-lg-2 order-3" id="navigation">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user-index') }}">Blogs</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('posts') }}">Posts</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">Category <i class="ti-angle-down ml-1"></i>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('category') }}">All</a>
                @foreach (\App\Models\Category::has('posts')->get() as $item)
                  <a class="dropdown-item" href="{{ route('category-show', $item->id) }}">{{ $item->name }}</a>
                @endforeach


              </div>
            </li>
          </ul>

          <ul class="navbar-nav">
            @auth
              <li class="nav-item dropdown">
                <a class="nav-link d-flex align-items-center" href="#" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false"> <img style="object-fit: cover;width: 40px;height: 40px;"
                    class="img-profile rounded-circle"
                    src="{{ Auth::user()->profile ? asset('storage/profile_img/' . Auth::user()->profile) : asset('storage/profile_img/profile_default.png') }}"><span
                    class="ml-1">
                    {{ Auth::user()->name }} </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>

                  {{-- <a class="dropdown-item" href="author.html">Logout</a> --}}

                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                  </form>

                </div>
              </li>
            @else
              <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">
                  Login
                </a></li>
              <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">
                  Register
                </a></li>

            @endauth
          </ul>

        </div>

        <div class="order-2 order-lg-3 d-flex align-items-center">


          <!-- search -->
          <form class="search-bar" action="{{ route('posts-search') }}">
            @csrf
            <input value="{{ old('search') }}" id="search-query" name="search" type="search"
              placeholder="Type &amp; Hit Enter...">
            <button hidden type="submit"></button>
          </form>

          <button class="navbar-toggler border-0 order-1" type="button" data-toggle="collapse"
            data-target="#navigation">
            <i class="ti-menu"></i>
          </button>
        </div>

      </nav>
    </div>
  </header>
  <!-- /navigation -->

  <!-- start of banner -->
  {{-- <div class="banner text-center">



    <svg class="banner-shape-1" width="39" height="40" viewBox="0 0 39 40" fill="none"
      xmlns="http://www.w3.org/2000/svg">
      <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z" stroke="#040306"
        stroke-miterlimit="10" />
      <path class="path" d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
      <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
        stroke-miterlimit="10" />
    </svg>

    <svg class="banner-shape-2" width="39" height="39" viewBox="0 0 39 39" fill="none"
      xmlns="http://www.w3.org/2000/svg">
      <g filter="url(#filter0_d)">
        <path class="path"
          d="M24.1587 21.5623C30.02 21.3764 34.6209 16.4742 34.435 10.6128C34.2491 4.75147 29.3468 0.1506 23.4855 0.336498C17.6241 0.522396 13.0233 5.42466 13.2092 11.286C13.3951 17.1474 18.2973 21.7482 24.1587 21.5623Z" />
        <path
          d="M5.64626 20.0297C11.1568 19.9267 15.7407 24.2062 16.0362 29.6855L24.631 29.4616L24.1476 10.8081L5.41797 11.296L5.64626 20.0297Z"
          stroke="#040306" stroke-miterlimit="10" />
      </g>
      <defs>
        <filter id="filter0_d" x="0.905273" y="0" width="37.8663" height="38.1979"
          filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
          <feFlood flood-opacity="0" result="BackgroundImageFix" />
          <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
          <feOffset dy="4" />
          <feGaussianBlur stdDeviation="2" />
          <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
          <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
          <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape" />
        </filter>
      </defs>
    </svg>


    <svg class="banner-shape-3" width="39" height="40" viewBox="0 0 39 40" fill="none"
      xmlns="http://www.w3.org/2000/svg">
      <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z" stroke="#040306"
        stroke-miterlimit="10" />
      <path class="path" d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
      <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
        stroke-miterlimit="10" />
    </svg>


    <svg class="banner-border" height="240" viewBox="0 0 2202 240" fill="none"
      xmlns="http://www.w3.org/2000/svg">
      <path
        d="M1 123.043C67.2858 167.865 259.022 257.325 549.762 188.784C764.181 125.427 967.75 112.601 1200.42 169.707C1347.76 205.869 1901.91 374.562 2201 1"
        stroke-width="2" />
    </svg>
  </div> --}}
  <!-- end of banner -->


  <section class="section-sm">
    <div class="container">
      <div class="row justify-content-center">
        @yield('content')
      </div>
    </div>
  </section>

  <footer class="footer">
    <svg class="footer-border" height="214" viewBox="0 0 2204 214" fill="none"
      xmlns="http://www.w3.org/2000/svg">
      <path
        d="M2203 213C2136.58 157.994 1942.77 -33.1996 1633.1 53.0486C1414.13 114.038 1200.92 188.208 967.765 118.127C820.12 73.7483 263.977 -143.754 0.999958 158.899"
        stroke-width="2" />
    </svg>

    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5 text-center text-md-left mb-4">
          <ul class="list-inline footer-list mb-0">
            <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
            <li class="list-inline-item"><a href="terms-conditions.html">Terms Conditions</a></li>
          </ul>
        </div>
        <div class="col-md-2 text-center mb-4">
          <h2>My Blog</h2>
        </div>
        <div class="col-md-5 text-md-right text-center mb-4">
          <ul class="list-inline footer-list mb-0">

            <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>

            <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>

            <li class="list-inline-item"><a href="#"><i class="ti-linkedin"></i></a></li>

            <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a></li>

            <li class="list-inline-item"><a href="#"><i class="ti-youtube"></i></a></li>

          </ul>
        </div>
        <div class="col-12">
          <div class="border-bottom border-default"></div>
        </div>
      </div>
    </div>
  </footer>

  {{-- jquery --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
    integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @livewireScripts()
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <!-- JS Plugins -->
  <script src="{{ asset('assets/front/plugins/jQuery/jquery.min.js') }}"></script>

  <script src="{{ asset('assets/front/plugins/bootstrap/bootstrap.min.js') }}"></script>

  <script src="{{ asset('assets/front/plugins/slick/slick.min.js') }}"></script>

  <script src="{{ asset('assets/front/plugins/instafeed/instafeed.min.js') }}"></script>


  <!-- Main Script -->
  <script src="{{ asset('assets/front/js/script.js') }}"></script>

  @stack('scripts')
</body>

</html>
