@extends('layouts.main-ecommerce')

@section('content')
<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Login</h2>
                    <nav class="breadcrumb">
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a class="disabled" href="javascript;">login</a></li>
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
            <div class="col-lg-6 mb-30">
                <div class="login shadow-light">
                    <div class="basic-form">
                        <h4>Already have an account</h4>
                        <h6>Log In</h6>
                        <form action="{{ route('user.login.submit') }}" method="POST">
                          {{ csrf_field() }}
                            <div class="form-group">
                              <input type="email" name="email" class="form-control" placeholder="User name / E-mail *" required="">
                            </div>
                            <div class="form-group">
                              <input type="password" name="password" class="form-control" placeholder="Password" required="">
                            </div>
                            <div class="form-check">
                              <input type="checkbox" name="remember" class="form-check-input" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                              <label class="form-check-label" for="remember-me">Remember me</label>
                            </div>
                            <button type="submit" class="btn mt-45">Log In</button>
                            &nbsp;&nbsp;&nbsp;<a style="position: relative; top: 23px;" href="{{ route('user-forgot') }}">Forgot Password?</a>
                          </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-30">
                <div class="create-account shadow-light h-100">
                    <div class="basic-form">
                        <h4>Don’t have an account</h4>
                        <h6>Create an account</h6>
                        <p>Sign up for a free account at our store. Registration is quick and easy. It allows you to be able to order from our shop. To start shopping click register.</p>
                        <a href="{{ route('user-register') }}" class="btn mt-45">create an account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Login end -->
@endsection