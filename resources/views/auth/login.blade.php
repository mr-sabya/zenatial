@extends('layouts.app')

@section('content')

<div class="login-box">
    <div class="login-logo">
        <a href="/"><img src="{{asset('assets/images/'.App\Models\Generalsetting::find(1)->logo)}}" alt="logo"></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            @include('partials.message')
            <form action="{{ route('admin.login.submit') }}" method="post">
                {{ csrf_field() }}
                <div class="input-group @error('email') @enderror mb-3">
                    <input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>              
                </div>
                <div class="input-group @error('password') is-invalid @enderror has-feedback mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>           
                </div>           
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>            
            </form>

            <br>
            <a href="{{ route('admin.forgot') }}">I forgot my password</a><br>

        </div>
        <!-- /.login-box-body -->
    </div>
</div>
<!-- /.login-box -->

@endsection
