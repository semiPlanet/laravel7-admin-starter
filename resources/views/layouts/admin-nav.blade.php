<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.home')}}" class="brand-link">
      @if(setting('logo'))
      <img src="{{setting('logo')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      @endif
      <span class="brand-text font-weight-light">{{setting('brand_name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/default-150x150.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('admin.home')}}" class="nav-link {{isroute('admin.home')}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item {{isroute('admin.list-admins', true) || isroute('admin.list-users', true)}}">
            <a href="#" class="nav-link {{isroute('admin.list-admins') || isroute('admin.list-users')}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.list-admins')}}" class="nav-link {{isroute('admin.list-admins')}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Admins</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.list-users')}}" class="nav-link {{isroute('admin.list-users')}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Users</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">SETTINGS</li>
          <li class="nav-item">
            <a href="{{route('admin.settings')}}" class="nav-link {{isroute('admin.settings')}}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>System Settings</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>