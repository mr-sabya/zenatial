<a class="nav-link {{ request()->is('user/dashboard') ? 'active' : '' }}" href="{{ route('user-dashboard') }}">Account information</a>
@if(Auth::user()->IsVendor())
  <a class="nav-link" href="{{ route('vendor-dashboard') }}">Vendor Dashboard</a>
@endif
<a class="nav-link" href="{{ route('user-order-track') }}">Order Track</a>
<a class="nav-link {{ request()->is('user/orders') ? 'active' : '' }}" href="{{ route('user-orders') }}">My order</a>
<a class="nav-link" href="{{ route('user-wishlists') }}">My wishlist</a>
<a class="nav-link" href="#newsletter">Newsletter</a>
<a class="nav-link {{ request()->is('user/profile') ? 'active' : '' }}" href="{{ route('user-profile') }}">My Account</a>
<a class="nav-link {{ request()->is('user/reset') ? 'active' : '' }}" href="{{ route('user-reset') }}">Change password</a>
<a class="nav-link" href="{{ route('user-logout') }}">Log out</a>