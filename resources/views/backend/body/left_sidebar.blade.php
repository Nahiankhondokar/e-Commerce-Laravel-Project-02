@php
  $prefix = Request::route() -> getPrefix(); // get prefix
  $route  = Route::current() -> getName(); // get name route
  $uri    =Route::getFacadeRoot() -> current() -> uri(); // get uri
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('admin/dashboard') }}" class="brand-link">
    <img src="{{ asset('backend/assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('media/backend/admin/'.Auth::guard('admin') -> user() -> profile_photo_path) }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ @Auth::guard('admin') -> user() -> name }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
             
            <!-- we can put active class in the every menu by putting session data.
             also we can do that by prefix or route name -->

             {{-- @if(Session::get('page') == 'admin-dashboard')
             @php
               $active = 'active';
             @endphp
            @else
              @php
                $active = '';
              @endphp
            @endif --}}
        <li class="nav-item menu-open">
          <a href="{{ url('/admin/dashboard') }}" class="nav-link {{ ($route == 'dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
        </li>

        <li class="nav-item ">
          <a href="" class="nav-link {{ ($prefix == '/admin') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Catalogues
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('section.view') }}" class="nav-link {{ ($route == 'section.view') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Sections</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('category.view') }}" class="nav-link {{ ($route == 'category.view') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Categories</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('product.view') }}" class="nav-link {{ ($route == 'product.view') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Product</p>
              </a>
            </li>

            
            <li class="nav-item">
              <a href="{{ route('brand.view') }}" class="nav-link {{ ($route == 'brand.view') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Brand</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('banner.view') }}" class="nav-link {{ ($route == 'banner.view') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Banner</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('coupon.view') }}" class="nav-link {{ ($route == 'coupon.view') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Coupon</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('admin.order.view') }}" class="nav-link {{ ($route == 'admin.order.view') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Order Item</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('shipping.view') }}" class="nav-link {{ ($route == 'shipping.view') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Shipping Charges</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('user.view') }}" class="nav-link {{ ($route == 'user.view') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All User</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('cms.view') }}" class="nav-link {{ ($route == 'cms.view') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>CMS</p>
              </a>
            </li>

            @if(Auth::guard('admin') -> user() -> type == 'superadmin' || Auth::guard('admin') -> user() -> type == 'admin')
            <li class="nav-item">
              <a href="{{ route('admin.subadmin.view') }}" class="nav-link {{ ($route == 'admin.subadmin.view') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Admin/SubAdmin</p>
              </a>
            </li>
            @endif

            
            <li class="nav-item">
              <a href="{{ route('currencie.view') }}" class="nav-link {{ ($route == 'currencie.view') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Currency Convert</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('rating.view') }}" class="nav-link {{ ($route == 'rating.view') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Ratings</p>
              </a>
            </li>

          </ul>
        </li>

        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>