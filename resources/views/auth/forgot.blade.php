@extends('layouts.app')

@section('content')
<div class="login-box">
    <div class="card">
        <div class="card-header">{{ __('Reset Password') }}</div>

        <div class="card-body">
            @include('partials.message')
            <form method="POST" action="{{ route('admin.forgot.submit') }}">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <a href="{{ route('admin.login') }}">Remember Password?</a>
        </div>
    </div>
</div>
@endsection
