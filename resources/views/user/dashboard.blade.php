@extends('layouts.main-ecommerce')

@section('content')
<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Account Dashboard</h2>
                    <nav class="breadcrumb">
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a class="disabled" href="javascript;">Account Dashboard</a></li>
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
                                <h3 class="mb-30">My Dashboard</h3>
                                <h6>Hello, {{ $user->name }}!</h6>
                                <p class="mb-50">This is your personalized dashboard. You can see all of your orders and wishlist. Happy Shopping!</p>

                                <h3 class="mb-0">Account Information</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="personal-info">
                                            <h6>Personal Information <a href="#">edit</a></h6>
                                            <ul>
                                                <li><span>Name:</span> {{ $user->name }}</li>
                                                <li><span>Email:</span> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
                                                <li><span>Password:</span> ************</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="address-book">
                                            <h6>address book <a href="#">edit</a></h6>
                                            <ul>
                                                <li><span>address:</span> {{ $user->address }}</li>
                                                <li><span>city:</span> {{ $user->city }}</li>
                                                <li><span>country:</span> {{ $user->country }}</li>
                                                <li><a class="theme-color-light" href="#">Set as default billing address</a></li>
                                                <li><u><a href="#" class="text-underline">Change address</a></u></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="my-order">
                                            <h6>My orders</h6>
                                            <?php
                                            if(get_object_vars($orders)){ 
                                            ?>
                                            <table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>#</th>
														<th>Date</th>
														<th>Order Total</th>
														<th>Order Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													 @foreach($orders as $order)
													<tr>
														<td>
																{{$order->order_number}}
														</td>
														<td>
																{{date('d M Y',strtotime($order->created_at))}}
														</td>
														<td>
																{{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}
														</td>
														<td>
															<div class="order-status {{ $order->status }}">
																	{{ucwords($order->status)}}
															</div>
														</td>
														<td>
															<a href="{{route('user-order',$order->id)}}">
																	View Order
															</a>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>  
                                            <?php 
                                            }else{
                                                echo 'You have not ordered anything yet.';
                                            }
                                            ?>                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="address-book" role="tabpanel">
                            <div class="tab-text">
                                <h3 class="mb-30">My Dashboard</h3>
                                <h6>Hello, John doe!</h6>
                                <p class="mb-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>

                                <h3 class="mb-0">Account Information</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="personal-info">
                                            <h6>Personal Information <a href="#">edit</a></h6>
                                            <ul>
                                                <li><span>Name:</span> John doe</li>
                                                <li><span>Email:</span> <a href="#">johndoe@domain.com</a></li>
                                                <li><span>Password:</span> ************</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="address-book">
                                            <h6>address book <a href="#">edit</a></h6>
                                            <ul>
                                                <li><span>address:</span> 123, Street name, City, State, Zip code.</li>
                                                <li><a class="theme-color-light" href="#">Set as default billing address</a></li>
                                                <li><u><a href="#" class="text-underline">Change address</a></u></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="my-order">
                                            <h6>My orders <a href="#">edit</a></h6>
                                            <ul>
                                                <li class="flex mb-20">
                                                    <div class="img">
                                                        <img src="assets/img/aiivals-1.jpg" alt="my-order">
                                                    </div>
                                                    <div class="text">
                                                        <p>Men special cotton shirt</p>
                                                        <p><span>Price:</span> $2,500.00</p>
                                                        <p><span>Status:</span> Delivered</p>
                                                    </div>
                                                </li>
                                                <li class="flex mb-20">
                                                    <div class="img">
                                                        <img src="assets/img/aiivals-1.jpg" alt="my-order">
                                                    </div>
                                                    <div class="text">
                                                        <p>Men special cotton shirt</p>
                                                        <p><span>Price:</span> $2,500.00</p>
                                                        <p><span>Status:</span> Delivered</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="my-address">
                                            <h6>My orders <a href="#">edit</a></h6>
                                            <p>You are currently not subscribe to any newsletter</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="my-order" role="tabpanel">
                            <div class="tab-text">
                                <h3 class="mb-30">My Dashboard</h3>
                                <h6>Hello, John doe!</h6>
                                <p class="mb-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>

                                <h3 class="mb-0">Account Information</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="personal-info">
                                            <h6>Personal Information <a href="#">edit</a></h6>
                                            <ul>
                                                <li><span>Name:</span> John doe</li>
                                                <li><span>Email:</span> <a href="#">johndoe@domain.com</a></li>
                                                <li><span>Password:</span> ************</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="address-book">
                                            <h6>address book <a href="#">edit</a></h6>
                                            <ul>
                                                <li><span>address:</span> 123, Street name, City, State, Zip code.</li>
                                                <li><a class="theme-color-light" href="#">Set as default billing address</a></li>
                                                <li><u><a href="#" class="text-underline">Change address</a></u></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="my-order">
                                            <h6>My orders <a href="#">edit</a></h6>
                                            <ul>
                                                <li class="flex mb-20">
                                                    <div class="img">
                                                        <img src="assets/img/aiivals-1.jpg" alt="my-order">
                                                    </div>
                                                    <div class="text">
                                                        <p>Men special cotton shirt</p>
                                                        <p><span>Price:</span> $2,500.00</p>
                                                        <p><span>Status:</span> Delivered</p>
                                                    </div>
                                                </li>
                                                <li class="flex mb-20">
                                                    <div class="img">
                                                        <img src="assets/img/aiivals-1.jpg" alt="my-order">
                                                    </div>
                                                    <div class="text">
                                                        <p>Men special cotton shirt</p>
                                                        <p><span>Price:</span> $2,500.00</p>
                                                        <p><span>Status:</span> Delivered</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="my-address">
                                            <h6>My orders <a href="#">edit</a></h6>
                                            <p>You are currently not subscribe to any newsletter</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="my-wishlist" role="tabpanel">
                            <div class="tab-text">
                                <h3 class="mb-30">My Dashboard</h3>
                                <h6>Hello, John doe!</h6>
                                <p class="mb-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>

                                <h3 class="mb-0">Account Information</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="personal-info">
                                            <h6>Personal Information <a href="#">edit</a></h6>
                                            <ul>
                                                <li><span>Name:</span> John doe</li>
                                                <li><span>Email:</span> <a href="#">johndoe@domain.com</a></li>
                                                <li><span>Password:</span> ************</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="address-book">
                                            <h6>address book <a href="#">edit</a></h6>
                                            <ul>
                                                <li><span>address:</span> 123, Street name, City, State, Zip code.</li>
                                                <li><a class="theme-color-light" href="#">Set as default billing address</a></li>
                                                <li><u><a href="#" class="text-underline">Change address</a></u></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="my-order">
                                            <h6>My orders <a href="#">edit</a></h6>
                                            <ul>
                                                <li class="flex mb-20">
                                                    <div class="img">
                                                        <img src="assets/img/aiivals-1.jpg" alt="my-order">
                                                    </div>
                                                    <div class="text">
                                                        <p>Men special cotton shirt</p>
                                                        <p><span>Price:</span> $2,500.00</p>
                                                        <p><span>Status:</span> Delivered</p>
                                                    </div>
                                                </li>
                                                <li class="flex mb-20">
                                                    <div class="img">
                                                        <img src="assets/img/aiivals-1.jpg" alt="my-order">
                                                    </div>
                                                    <div class="text">
                                                        <p>Men special cotton shirt</p>
                                                        <p><span>Price:</span> $2,500.00</p>
                                                        <p><span>Status:</span> Delivered</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="my-address">
                                            <h6>My orders <a href="#">edit</a></h6>
                                            <p>You are currently not subscribe to any newsletter</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="newsletter" role="tabpanel">
                            <div class="tab-text">
                                <h3 class="mb-30">My Dashboard</h3>
                                <h6>Hello, John doe!</h6>
                                <p class="mb-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>

                                <h3 class="mb-0">Account Information</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="personal-info">
                                            <h6>Personal Information <a href="#">edit</a></h6>
                                            <ul>
                                                <li><span>Name:</span> John doe</li>
                                                <li><span>Email:</span> <a href="#">johndoe@domain.com</a></li>
                                                <li><span>Password:</span> ************</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="address-book">
                                            <h6>address book <a href="#">edit</a></h6>
                                            <ul>
                                                <li><span>address:</span> 123, Street name, City, State, Zip code.</li>
                                                <li><a class="theme-color-light" href="#">Set as default billing address</a></li>
                                                <li><u><a href="#" class="text-underline">Change address</a></u></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="my-order">
                                            <h6>My orders <a href="#">edit</a></h6>
                                            <ul>
                                                <li class="flex mb-20">
                                                    <div class="img">
                                                        <img src="assets/img/aiivals-1.jpg" alt="my-order">
                                                    </div>
                                                    <div class="text">
                                                        <p>Men special cotton shirt</p>
                                                        <p><span>Price:</span> $2,500.00</p>
                                                        <p><span>Status:</span> Delivered</p>
                                                    </div>
                                                </li>
                                                <li class="flex mb-20">
                                                    <div class="img">
                                                        <img src="assets/img/aiivals-1.jpg" alt="my-order">
                                                    </div>
                                                    <div class="text">
                                                        <p>Men special cotton shirt</p>
                                                        <p><span>Price:</span> $2,500.00</p>
                                                        <p><span>Status:</span> Delivered</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="my-address">
                                            <h6>My orders <a href="#">edit</a></h6>
                                            <p>You are currently not subscribe to any newsletter</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="my-account" role="tabpanel">
                            <div class="tab-text">
                                <h3 class="mb-30">My Dashboard</h3>
                                <h6>Hello, John doe!</h6>
                                <p class="mb-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>

                                <h3 class="mb-0">Account Information</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="personal-info">
                                            <h6>Personal Information <a href="#">edit</a></h6>
                                            <ul>
                                                <li><span>Name:</span> John doe</li>
                                                <li><span>Email:</span> <a href="#">johndoe@domain.com</a></li>
                                                <li><span>Password:</span> ************</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="address-book">
                                            <h6>address book <a href="#">edit</a></h6>
                                            <ul>
                                                <li><span>address:</span> 123, Street name, City, State, Zip code.</li>
                                                <li><a class="theme-color-light" href="#">Set as default billing address</a></li>
                                                <li><u><a href="#" class="text-underline">Change address</a></u></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="my-order">
                                            <h6>My orders <a href="#">edit</a></h6>
                                            <ul>
                                                <li class="flex mb-20">
                                                    <div class="img">
                                                        <img src="assets/img/aiivals-1.jpg" alt="my-order">
                                                    </div>
                                                    <div class="text">
                                                        <p>Men special cotton shirt</p>
                                                        <p><span>Price:</span> $2,500.00</p>
                                                        <p><span>Status:</span> Delivered</p>
                                                    </div>
                                                </li>
                                                <li class="flex mb-20">
                                                    <div class="img">
                                                        <img src="assets/img/aiivals-1.jpg" alt="my-order">
                                                    </div>
                                                    <div class="text">
                                                        <p>Men special cotton shirt</p>
                                                        <p><span>Price:</span> $2,500.00</p>
                                                        <p><span>Status:</span> Delivered</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="my-address">
                                            <h6>My orders <a href="#">edit</a></h6>
                                            <p>You are currently not subscribe to any newsletter</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="change-password" role="tabpanel">
                            <div class="tab-text">
                                <h3 class="mb-30">My Dashboard</h3>
                                <h6>Hello, John doe!</h6>
                                <p class="mb-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>

                                <h3 class="mb-0">Account Information</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="personal-info">
                                            <h6>Personal Information <a href="#">edit</a></h6>
                                            <ul>
                                                <li><span>Name:</span> John doe</li>
                                                <li><span>Email:</span> <a href="#">johndoe@domain.com</a></li>
                                                <li><span>Password:</span> ************</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="address-book">
                                            <h6>address book <a href="#">edit</a></h6>
                                            <ul>
                                                <li><span>address:</span> 123, Street name, City, State, Zip code.</li>
                                                <li><a class="theme-color-light" href="#">Set as default billing address</a></li>
                                                <li><u><a href="#" class="text-underline">Change address</a></u></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="my-order">
                                            <h6>My orders <a href="#">edit</a></h6>
                                            <ul>
                                                <li class="flex mb-20">
                                                    <div class="img">
                                                        <img src="assets/img/aiivals-1.jpg" alt="my-order">
                                                    </div>
                                                    <div class="text">
                                                        <p>Men special cotton shirt</p>
                                                        <p><span>Price:</span> $2,500.00</p>
                                                        <p><span>Status:</span> Delivered</p>
                                                    </div>
                                                </li>
                                                <li class="flex mb-20">
                                                    <div class="img">
                                                        <img src="assets/img/aiivals-1.jpg" alt="my-order">
                                                    </div>
                                                    <div class="text">
                                                        <p>Men special cotton shirt</p>
                                                        <p><span>Price:</span> $2,500.00</p>
                                                        <p><span>Status:</span> Delivered</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="my-address">
                                            <h6>My orders <a href="#">edit</a></h6>
                                            <p>You are currently not subscribe to any newsletter</p>
                                        </div>
                                    </div>
                                </div>
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