@extends('layouts.main-ecommerce')


@section('content')
<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Order Details</h2>
                    <nav class="breadcrumb">
                        <ul>
                            <li><a href="javascript:;">home</a></li>
                            <li><a href="javascript:;">Order</a></li>
                            <li><a class="disabled" href="javascript:;">Order Details</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner end -->

<!-- Delivery-tracking start -->
<section class="delivery-tracking pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="your-order">
                    <p class="title mb-0">your order <span>all</span></p>
                    <div class="description flex left-center p-20 white-bg">
                        <p>
                            <span class="date">{{date('d-M-Y',strtotime($order->created_at))}}</span>
                            <span class="order-no text-uppercase">{{$order->order_number}}</span>
                        </p>
                        <p class="ml-auto">
                            <span class="status">{{$order->status}}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="invoice">
                    <div class="title d-flex left-top justify-content-between">
                        <p>Invoice: 
                            <span class="text-uppercase">{{$order->order_number}}</span>
                            <span class="date">{{date('d-M-Y',strtotime($order->created_at))}}</span>
                        </p>
                        <a href="#" class="btn">Request refund</a>
                    </div>
                </div>
                <div class="confirm-delivery mt-50 shadow-light">
                    <div class="title card-bg flex left-center justify-content-between p-20">
                        <p class="text-color m-0">Did you receive the product?</p>
                        <a href="#" class="btn white-btn">confirm delivery</a>
                    </div>
                    <div class="row p-30 pt-50 pb-50 white-bg m-0">
                        <div class="col-lg-6 mb-30">
                            <h3 class="mb-35">Bills to</h3>
                            <div class="order-from flex left-center mb-40">
                                <div class="description">
                                    <p class="name">{{ $order->customer_name }}</p>
                                    <p class="address">{{ $order->customer_address }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-30">
                            <h3 class="mb-35">Ships to</h3>
                            <div class="bills-to flex left-center mb-40">
                                <div class="description">
                                    <p class="name">{{$order->shipping_name == null ? $order->customer_name : $order->shipping_name}}</p>
                                    <p class="address">{{$order->shipping_address == null ? $order->customer_address : $order->shipping_address}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-description mt-50 bg-white p-30 pt-50 pb-50 shadow-light">
                    <h3>product description</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="shadow-light">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total price</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($cart->items as $product)
                                <tr class="pb-30 pt-30">
                                    <td><img class="w-100 img-fluid" src="{{ asset('assets/images/products/'.$product['item']['photo']) }}" alt="card-img"> </td>
                                    <td>
                                        <a target="_blank"
                                            href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>                                  
                                    </td>
                                    <td>
                                    <b>Quantity</b>: {{$product['qty']}} <br>
                                    @if(!empty($product['size']))
                                    <b>Size</b>: {{ $product['item']['measure'] }}{{str_replace('-',' ',$product['size'])}} <br>
                                    @endif
                                    @if(!empty($product['color']))
                                    <div class="d-flex mt-2">
                                    <b>Color</b>:  <span id="color-bar" style="border: 10px solid {{$product['color'] == "" ? "white" : '#'.$product['color']}};"></span>
                                    </div>
                                    @endif
                                    @if(!empty($product['keys']))

                                    @foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values']))  as $key => $value)

                                        <b>{{ ucwords(str_replace('_', ' ', $key))  }} : </b> {{ $value }} <br>
                                    @endforeach

                                    @endif                                    
                                    </td>
                                    <td>{{$order->currency_sign}}{{round($product['item']['price'] * $order->currency_value,2)}}</td>
                                    <td>{{$order->currency_sign}}{{round($product['price'] * $order->currency_value,2)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <p class="text-color mt-20">Status:                                              {!! $order->payment_status == 'Pending' ? "<span class='badge badge-danger'>Unpaid</span>":"<span class='badge badge-success'>Paid</span>" !!}</p>
                    </div>
                </div>
                <div class="timeline mt-50 bg-white p-30 pt-50 pb-50 shadow-light">
                    <ul>
                    @foreach($order->tracks as $track)
                        <li class="starting">
                            <i class="fas fa-check"></i>
                            <h6>{{ ucwords($track->title)}}</h6>
                            <p>{{ date('d m Y',strtotime($track->created_at)) }}</p>
                            <p>{{ $track->text }}</p>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Delivery-tracking end -->
@endsection