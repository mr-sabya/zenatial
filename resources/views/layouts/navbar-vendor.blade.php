  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{ App\Models\Order::where('status','=','pending')->count() }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{ App\Models\Order::where('status','=','pending')->count() }} Pending Order(s)</span>
          @foreach(App\Models\Order::where('status','=','pending')->latest()->get() as $order)
            <a href="{{ route('admin-order-show', $order->id) }}" class="dropdown-item">
              <strong>{{ $order->customer_name }}</strong> ordered {{ $order->totalQty }} item(s)
              <p class="text-muted text-sm">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($order->created_at))->diffForHumans() }}</p>
            </a>
          @endforeach
      </li>
      <li class="nav-item ml-3">

      </li>
      <li class="nav-item dropdown">
        <a class="dropdown-toggle-1" data-toggle="dropdown" href="#">
          <div class="user-img">
            <img style="width:40px; height:auto;" src="{{ Auth::guard('web')->user()->photo ? asset('assets/images/users/'.Auth::guard('web')->user()->photo ):asset('assets/images/noimage.png') }}" alt="">
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('user-dashboard') }}"><i class="fas fa-cog"></i> {{ __('User Dashboard') }}</a>
            <a class="dropdown-item" href="{{ route('user-logout') }}"><i class="fas fa-power-off"></i> {{ __('Logout') }}</a>
        </div>
      </li>           
    </ul>
  </nav>
  <!-- /.navbar -->