@extends('layouts.main-ecommerce')

@section('content')
<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Reset Password</h2>
                    <nav class="breadcrumb">
                        <ul>
                            <li><a href="javascript:;">home</a></li>
                            <li><a href="javascript:;">login</a></li>
                            <li><a class="disabled" href="javascript:;">Reset Password</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner end -->

<!-- Login start -->
<section class="login-page pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-30 offset-3">
                <div class="login shadow-light">
                    <div class="basic-form">
                        <h4>Reset your Password</h4>
                        <h6>Email</h6>
                        <form action="{{route('user-forgot-submit')}}" method="POST">
                          {{ csrf_field() }}
                            <div class="form-group">
                              <input type="email" name="email" class="form-control" placeholder="Enter your email" required="">
                            </div>
                            <button type="submit" class="btn mt-45">Log In</button>
                            &nbsp;&nbsp;&nbsp;<a style="position: relative; top: 23px;" href="{{ route('user.login') }}">Remembered Password? Login</a>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Login end -->
@endsection