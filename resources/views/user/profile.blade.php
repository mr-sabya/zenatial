@extends('layouts.main-ecommerce')

@section('content')
<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Profile</h2>
                    <nav class="breadcrumb">
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a class="disabled" href="javascript;">Profile</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner end -->

<!-- Account-dashboard start -->
<section class="account-dashboard pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="tab-items shadow-light">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @include('includes.user-dashboard-sidebar')
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="tab-content">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="account-info" role="tabpanel">
                            <div class="tab-text">
                                <h3 class="mb-30">Edit Profile</h3>
                                <form action="{{route('user-profile-update')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input name="name" type="text" class="form-control" placeholder="Name" required="" value="{{ $user->name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input name="email" type="email" class="form-control" placeholder="Email" required="" value="{{ $user->email }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input name="phone" type="text" class="form-control" placeholder="Phone" required="" value="{{ $user->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input name="city" type="text" class="form-control" placeholder="City" value="{{ $user->city }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="password">Country</label>
                                                <select class="form-control" name="country">
                                                    <option value="">Select Country</option>
                                                    @foreach (DB::table('countries')->get() as $data)
                                                        <option value="{{ $data->country_name }}" {{ $user->country == $data->country_name ? 'selected' : '' }}>
                                                            {{ $data->country_name }}
                                                        </option>		
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Post Code</label>
                                                <input name="zip" type="text" class="form-control" placeholder="Post Code" value="{{ $user->zip }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" name="address" required="" placeholder="Address">{{ $user->address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <button class="btn" type="submit">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Account-dashboard end -->
@endsection