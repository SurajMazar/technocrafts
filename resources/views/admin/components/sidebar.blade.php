<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <span class="brand-text font-weight-light">Technocrafts</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }} </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-item">
          <a href="{{ route('admin') }}" class="nav-link {{ Route::currentRouteNamed('admin') ? 'active' :''}}">
            <i class="far fa-gem nav-icon"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.noticeboard') }}" class="nav-link {{ Route::currentRouteNamed('admin.noticeboard') ? 'active' :''}}">
            <i class="  far fa-clipboard nav-icon"></i>
            <p>Noticeboard</p>
          </a>
        </li>
        <li class="nav-header">Blogs and Gadgets</li>
        <li class="nav-item has-treeview {{ Route::currentRouteNamed('admin.blogs')||Route::currentRouteNamed('admin.blog_category')||Route::currentRouteNamed('admin.blogs_create_page')||Route::currentRouteNamed('admin.blog_edit_page')||Route::currentRouteNamed('admin.admin.trashblog')||Route::currentRouteNamed('admin.admin.trashblog') ? 'menu-open' :'' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fab fa-blogger-b"></i>
            <p>
              Blogs
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.blogs') }}" class="nav-link {{ Route::currentRouteNamed('admin.blogs')||Route::currentRouteNamed('admin.blogs_create_page')||Route::currentRouteNamed('admin.blog_edit_page')||Route::currentRouteNamed('admin.admin.trashblog') ? 'active' :''}} ">
                <i class="far fa-circle nav-icon"></i>
                <p>Blogs</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.blog_category') }}" class="nav-link {{ Route::currentRouteNamed('admin.blog_category') ? 'active' :''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Categories</p>
              </a>
            </li>
          </ul>
        </li>

        @can('isAdmin',Auth::user())
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-laptop"></i>
            <p>
              Gadgets
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.laptop') }}" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Laptops</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.brands') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Laptops Brands</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('admin.smartphone') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Smart Phones </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('admin.smartphonebrands') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Smart Phones brands</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">Advertisement</li>
        {{-- advertisement manager --}}
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon    fas fa-bullhorn"></i>
            <p>
              Ads manager
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.ads') }}" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Ads</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.ads_category') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ads Categories</p>
              </a>
            </li>
          </ul>
        </li>
        {{-- advertisement manager end --}}
        <li class="nav-header">Submissions</li>
          <li class="nav-item">
            <a href="{{ route('admin.Writing') }}" class="nav-link">
              <i class="fas fa-pen-nib nav-icon"></i>
              <p>Writing Submissions</p>

            </a>
          </li>

          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="far fa-comment nav-icon"></i>
              <p>Contact form</p>
            </a>
          </li>

          <li class="nav-header">Newsletter</li>

          <li class="nav-item">
            <a href="{{ route('admin.subscriber') }}" class="nav-link">
              <i class="fas fa-users nav-icon"></i>
              <p>Subscribers</p>
            </a>
          </li>
        @endcan

       <li class="nav-header">Setting</li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-user-cog"></i>
            <p>User management</p>
            <i class="right fas fa-angle-left"></i>
          </a>
           <ul class="nav nav-treeview">
            @can('isAdmin',Auth::user())
            <li class="nav-item">
              <a href="{{ route('user') }}" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Users</p>
              </a>
            </li>
            @endcan
            <li class="nav-item">
            <a href="{{route('admin.profile')}}" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Profile setting</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-power-off"></i>
            <p>
              Logout
            </p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
          </form>
        </li>
        
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>