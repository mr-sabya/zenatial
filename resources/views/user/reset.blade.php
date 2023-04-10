@extends('layouts.main-ecommerce')

@section('content')
<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Change password</h2>
                    <nav class="breadcrumb">
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a class="disabled" href="javascript;">Change password</a></li>
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
                                <h3 class="mb-30">Change password</h3>
                                <form id="userform" action="{{route('user-reset-submit')}}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }} 
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="password" name="cpass"  class="form-control" placeholder="Old Password" value="" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">                                        
                                                <input type="password" name="newpass"  class="form-control" placeholder="New Password" value="" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="password" name="renewpass"  class="form-control" placeholder="Confirm Password" value="" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-links">
                                        <button class="btn" type="submit">Change Password</button>
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