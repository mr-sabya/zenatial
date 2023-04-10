  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('vendor-dashboard') }}" class="brand-link text-center">
      <span class="brand-text font-weight-light"><img style="width: 120px; height: auto;" src="{{asset('assets/images/'.App\Models\Generalsetting::find(1)->logo)}}" alt="logo"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Auth::guard('web')->user()->photo ? asset('assets/images/admins/'.Auth::guard('web')->user()->photo ):asset('assets/images/noimage.png') }}" alt="">
        </div>
        <div class="info">
          <a href="" class="d-block">Welcome, {{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('vendor-dashboard') }}" class="nav-link {{ request()->is('vendor/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview {{ request()->is('vendor/orders') || request()->is('vendor/orders/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('vendor/orders') || request()->is('vendor/orders/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Order
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a class="nav-link" href="{{route('vendor-order-index')}}"><i class="far fa-circle nav-icon"></i><p>All Orders</p></a>
              </li>           
            </ul>            
          </li>
          <li class="nav-item has-treeview {{ request()->is('vendor/products') || request()->is('vendor/products/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('vendor/products') || request()->is('vendor/products/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('vendor-prod-create') }}"><i class="far fa-circle nav-icon"></i><p>Add New Product</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('vendor-prod-index') }}"><i class="far fa-circle nav-icon"></i><p>All Products</p></a>
              </li>           
            </ul>            
          </li> 
          <li class="nav-item has-treeview {{ request()->is('vendor/withdraw') || request()->is('vendor/withdraw/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('vendor/withdraw') || request()->is('vendor/withdraw/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Withdraw
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('vendor-wt-create') }}"><i class="far fa-circle nav-icon"></i><p>Add New Withdraw Request</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('vendor-wt-index') }}"><i class="far fa-circle nav-icon"></i><p>All Withdraws</p></a>
              </li>           
            </ul>            
          </li>       
		  <li class="nav-item"><hr></li>	  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>