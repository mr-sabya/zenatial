@extends('layouts.main-ecommerce')

@section('content')
<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Register</h2>
                    <nav class="breadcrumb">
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a class="disabled" href="#">register</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner end -->

<!-- Register start -->
<section class="register-page mt-120 mb-120">
    <div class="container basic-form">
        <div class="register-text shadow-light">
            <form action="{{route('user-register-submit')}}" method="POST">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">First name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="First name" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control" id="address" placeholder="Address" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="con-password">Confirm password</label>
                            <input type="password" class="form-control" id="con-password" placeholder="Confirm password" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn">create account</button>
                        &nbsp;&nbsp;&nbsp;<a href="{{ route('user.login') }}">Have an Account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Register end -->
@endsection