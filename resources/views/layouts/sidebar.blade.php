  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
      <span class="brand-text font-weight-light"><img style="width: 120px; height: auto;" src="{{asset('assets/images/'.App\Models\Generalsetting::find(1)->logo)}}" alt="logo"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Auth::guard('admin')->user()->photo ? asset('assets/images/admins/'.Auth::guard('admin')->user()->photo ):asset('assets/images/noimage.png') }}" alt="">
        </div>
        <div class="info">
          <a href="javascript:;" class="d-block">Welcome, {{ Auth::guard('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview {{ request()->is('admin/orders/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/orders/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Order
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a class="nav-link" href="{{route('admin-order-index')}}"><i class="far fa-circle nav-icon"></i><p>All Orders</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{route('admin-order-index', 'pending')}}"><i class="far fa-circle nav-icon"></i><p>Pending Orders</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{route('admin-order-index', 'processing')}}"><i class="far fa-circle nav-icon"></i><p>Processing Orders</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{route('admin-order-index', 'completed')}}"><i class="far fa-circle nav-icon"></i><p>Completed Orders</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{route('admin-order-index', 'declined')}}"><i class="far fa-circle nav-icon"></i><p>Declined Orders</p></a>
              </li>            
            </ul>            
          </li>
          <li class="nav-item has-treeview {{ request()->is('admin/products') || request()->is('admin/products/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/products') || request()->is('admin/products/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-prod-create') }}"><i class="far fa-circle nav-icon"></i><p>Add New Product</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-prod-index') }}"><i class="far fa-circle nav-icon"></i><p>All Products</p></a>
              </li>         
            </ul>            
          </li>
          <li class="nav-item has-treeview {{ request()->is('admin/users') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Customers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a class="nav-link" href="{{route('admin-user-index')}}"><i class="far fa-circle nav-icon"></i><p>Customers List</p></a>
              </li>
            </ul>            
          </li>
          <li class="nav-item has-treeview {{ request()->is('admin/vendors') || request()->is('admin/vendors/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/vendors') || request()->is('admin/vendors/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Vendors
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a class="nav-link" href="{{route('admin-vendor-index')}}"><i class="far fa-circle nav-icon"></i><p>Vendors List</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{route('admin-vendor-withdraw-index')}}"><i class="far fa-circle nav-icon"></i><p>Withdraws</p></a>
              </li>        
            </ul>            
          </li>
          <li class="nav-item has-treeview {{ request()->is('admin/verifications') || request()->is('admin/verifications/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/verifications') || request()->is('admin/verifications/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Vendor Verifications
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a class="nav-link" href="{{route('admin-vr-index')}}"><i class="far fa-circle nav-icon"></i><p>All Verifications</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{route('admin-vr-index', 'pending')}}"><i class="far fa-circle nav-icon"></i><p>Pending Verifications</p></a>
              </li>          
            </ul>            
          </li>
          <li class="nav-item has-treeview {{ request()->is('admin/category') || request()->is('admin/subcategory') || request()->is('admin/childcategory') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/category') || request()->is('admin/subcategory') || request()->is('admin/childcategory') ? 'active' : '' }}">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Manage Categories
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin-cat-index') }}"><i class="far fa-circle nav-icon"></i><p>Main Category</p></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin-subcat-index') }}"><i class="far fa-circle nav-icon"></i><p>Sub Category</p></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin-childcat-index') }}"><i class="far fa-circle nav-icon"></i><p>Child Category</p></a>
              </li>         
            </ul>            
          </li>
          <li class="nav-item has-treeview {{ request()->is('admin/ratings') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/ratings') ? 'active' : '' }}">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Product Feedback
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-rating-index') }}"><i class="far fa-circle nav-icon"></i><p>Product Reviews</p></a>
              </li>
              <!--
              <li class="nav-item">
                  <a class="nav-link" href="#"><i class="far fa-circle nav-icon"></i><p>Comments</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#"><i class="far fa-circle nav-icon"></i><p>Reports</p></a>
              </li>
              -->         
            </ul>            
          </li>
          <li class="nav-item has-treeview {{ request()->is('admin/ratings') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/ratings') ? 'active' : '' }}">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Coupons
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-coupon-create') }}"><i class="far fa-circle nav-icon"></i><p>Add New Coupon</p></a>
              </li>       
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-coupon-index') }}"><i class="far fa-circle nav-icon"></i><p>All Coupon</p></a>
              </li>       
            </ul>            
          </li>          
          <li class="nav-item has-treeview {{ request()->is('admin/ratings') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/ratings') ? 'active' : '' }}">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Homepage Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-banner', 'under-slider') }}"><i class="far fa-circle nav-icon"></i><p>Under Slider Banner</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-banner', 'large') }}"><i class="far fa-circle nav-icon"></i><p>Large Middle Banner</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-banner', 'weekly-deal') }}"><i class="far fa-circle nav-icon"></i><p>Deal of the Week</p></a>
              </li>       
            </ul>            
          </li>          
          <li class="nav-item has-treeview {{ request()->is('admin/blog') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/blog') ? 'active' : '' }}">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Blog
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-blog-index') }}"><i class="far fa-circle nav-icon"></i><p>All Posts</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-cblog-index') }}"><i class="far fa-circle nav-icon"></i><p>Category</p></a>
              </li>      
            </ul>            
          </li>          
          <li class="nav-item has-treeview {{ request()->is('admin/page-settings/contact') || request()->is('admin/faq') || request()->is('admin/faq/*') || request()->is('admin/page') || request()->is('admin/page/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/page-settings/contact') || request()->is('admin/faq') || request()->is('admin/faq/*') || request()->is('admin/page') || request()->is('admin/page/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Pages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-faq-index') }}"><i class="far fa-circle nav-icon"></i><p>FAQ Page</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-faqcat-index') }}"><i class="far fa-circle nav-icon"></i><p>FAQ Category</p></a>
              </li>      
            </ul>            
          </li>        
          <li class="nav-item">
            <a href="{{ route('admin-banner', 'nav-banner') }}" class="nav-link {{ request()->is('admin/nav-banner') ? 'active' : '' }}"><i class="nav-icon fas fa-tachometer-alt"></i><p>Nav Banner</p></a>
          </li>        
          <li class="nav-item">
            <a href="{{ route('admin-subs-index') }}" class="nav-link {{ request()->is('admin/subscribers') ? 'active' : '' }}"><i class="nav-icon fas fa-tachometer-alt"></i><p>Subscribers</p></a>
          </li>          
          <li class="nav-item has-treeview {{ request()->is('admin/general-settings/logo') || request()->is('admin/general-settings/favicon') || request()->is('admin/shipping') || request()->is('admin/general-settings/contents') || request()->is('admin/general-settings/top-header') || request()->is('admin/general-settings/footer') || request()->is('admin/general-settings/popup') ? 'menu-open' : '' }}">
            
            <a href="#" class="nav-link {{ request()->is('admin/general-settings/logo') || request()->is('admin/general-settings/favicon') || request()->is('admin/shipping') || request()->is('admin/general-settings/contents') || request()->is('admin/general-settings/top-header') || request()->is('admin/general-settings/footer') || request()->is('admin/general-settings/popup') ? 'active' : '' }}">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                General Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-gs-logo') }}"><i class="far fa-circle nav-icon"></i><p>Logo</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-gs-fav') }}"><i class="far fa-circle nav-icon"></i><p>Favicon</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-shipping-index') }}"><i class="far fa-circle nav-icon"></i><p>Shipping Methods</p></a>
              </li>
              <li class="nav-item">
              <a class="nav-link" href="{{ route('admin-gs-contents') }}"><i class="far fa-circle nav-icon"></i><p>Sitewide Settings</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-gs-top-header') }}"><i class="far fa-circle nav-icon"></i><p>Top Header</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-gs-footer') }}"><i class="far fa-circle nav-icon"></i><p>Footer</p></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin-gs-popup') }}"><i class="far fa-circle nav-icon"></i><p>Newsletter</p></a>
              </li>     
            </ul>            
          </li>
          <li class="nav-item">
            <a href="{{ route('admin-gs-seo') }}" class="nav-link {{ request()->is('admin/general-settings/seo') ? 'active' : '' }}"><i class="nav-icon fas fa-tachometer-alt"></i><p>SEO Settings</p></a>
          </li>          
          <li class="nav-item">
            <a href="{{ route('admin-gs-social') }}" class="nav-link {{ request()->is('admin/general-settings/social') ? 'active' : '' }}"><i class="nav-icon fas fa-tachometer-alt"></i><p>Social Links</p></a>
          </li>          
          <li class="nav-item">
            <a href="{{ route('admin-role-index') }}" class="nav-link {{ request()->is('admin/role') || request()->is('admin/role/*') ? 'active' : '' }}"><i class="nav-icon fas fa-tachometer-alt"></i><p>Roles</p></a>
          </li>          
          <li class="nav-item">
            <a href="{{ route('admin-staff-index') }}" class="nav-link {{ request()->is('admin/staff') || request()->is('admin/staff/*') ? 'active' : '' }}"><i class="nav-icon fas fa-tachometer-alt"></i><p>Staffs</p></a>
          </li>
		  <li class="nav-item"><hr></li>	  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>