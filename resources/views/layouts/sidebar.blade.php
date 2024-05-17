<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    @php
        $profile = App\Models\Profile::select('profile_name','profile_logo')->first();
    @endphp
    <a class="navbar-brand m-0" href=" / " 
    target="_blank">
    @if ($profile && $profile->profile_logo !== null)
      <img src="{{asset('images_profile/'.$profile->profile_logo)}}" class="navbar-brand-img h-100" alt="main_logo">
      {{-- <span class="ms-1 font-weight-bold">{{$profile->profile_name}}</span> --}}
    @else
      <img src="{{asset('assets/img/logo-ct-dark.png')}}" class="navbar-brand-img h-100" alt="main_logo">
      {{-- <span class="ms-1 font-weight-bold">ADMIN PANEL CMS</span> --}}
    @endif
      
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin-dashboard') ? 'active' : '' }}" href="/admin-dashboard">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  {{ request()->routeIs('admin-menus') ? 'active' : '' }}" href="/admin-menus">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Menu / Submenu</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin-konten') ? 'active' : '' }}" href="/admin-konten">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-app text-info text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Konten</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " {{ request()->routeIs('admin-kategori') ? 'active' : '' }} href="/admin-kategori">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Kategori</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="/admin-alumni">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-facebook text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Social Media</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Review Daftar Alumni</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="/admin-alumni">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Alumni</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Credentials</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="/admin-users">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-user text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Users</span>
        </a>
      </li>
    </ul>
  </div>
  <div class="sidenav-footer mx-3 ">
    <div class="card card-plain shadow-none" id="sidenavCard">
      <img class="w-50 mx-auto" src="{{asset('assets/img/illustrations/icon-documentation.svg')}}" alt="sidebar_illustration">
      <div class="card-body text-center p-3 w-100 pt-0">
        <div class="docs-info">
          <h6 class="mb-0">CMS</h6>
          <p class="text-xs font-weight-bold mb-0">Content Management System</p>
        </div>
      </div>
    </div>
    <a href="/admin-post" class="btn btn-dark btn-sm w-100 mb-3">POSTING</a>
    <a class="btn btn-primary btn-sm mb-0 w-100" href="/admin-setting" type="button">SETTINGS</a>
  </div>
</aside>