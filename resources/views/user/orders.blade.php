@extends('layouts.main-ecommerce')

@section('content')
<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>My Orders</h2>
                    <nav class="breadcrumb">
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a class="disabled" href="javascript;">My Orders</a></li>
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
                                <h3 class="mb-30">My Orders</h3>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="my-order">
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Account-dashboard end -->
@endsection