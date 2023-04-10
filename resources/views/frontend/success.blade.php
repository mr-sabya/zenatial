@extends('layouts.main-ecommerce')

@section('content')
<section class="tempcart">
<div class="card">
<div class="card-body">
@if(!empty($tempcart))

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Starting of Dashboard data-table area -->
                    <div class="content-box section-padding add-product-1">
                        <div class="top-area">
                                <div class="content">
                                    <h4 class="heading">
                                    THANK YOU FOR YOUR PURCHASE.
                                    </h4>
                                    <p class="text">
                                    We'll email you an order confirmation with details and tracking info.
                                    </p>
                                    <a href="{{ route('front.index') }}" class="link">Get Back To Our Homepage</a>
                                  </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">

                                    <div class="product__header">
                                        <div class="row reorder-xs">
                                            <div class="col-lg-12">
                                                <div class="product-header-title">
                                                    <h2>Order# {{$order->order_number}}</h2>
                                        </div>   
                                    </div>
                                        @include('includes.form-success')
                                            <div class="col-md-12" id="tempview">
                                                <div class="dashboard-content">
                                                    <div class="view-order-page" id="print">
                                                        <p class="order-date">Order Date {{date('d-M-Y',strtotime($order->created_at))}}</p>


@if($order->dp == 1)

                                                        <div class="billing-add-area">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h5>Billing Address</h5>
                                                                    <address>
                                                                    Name: {{$order->customer_name}}<br>
                                                                    Email: {{$order->customer_email}}<br>
                                                                    Phone: {{$order->customer_phone}}<br>
                                                                    Address: {{$order->customer_address}}<br>
                                                                        {{$order->customer_city}}-{{$order->customer_zip}}
                                                                    </address>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5>Payment Information</h5>
                                                                    <p>Paid Amount: {{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}</p>
                                                                    <p>Payment Method: {{$order->method}}</p>

                                                                    @if($order->method != "Cash On Delivery")
                                                                        @if($order->method=="Stripe")
                                                                            {{$order->method}} Charge ID: <p>{{$order->charge_id}}</p>
                                                                        @endif
                                                                        {{$order->method}} Transaction ID: <p id="ttn">{{$order->txnid}}</p>

                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

@else
                                                        <div class="shipping-add-area">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    @if($order->shipping == "shipto")
                                                                        <h5>Shipping Address</h5>
                                                                        <address>
                                                                        Billing Address {{$order->shipping_name == null ? $order->customer_name : $order->shipping_name}}<br>
                                                                        Email: {{$order->shipping_email == null ? $order->customer_email : $order->shipping_email}}<br>
                Phone: {{$order->shipping_phone == null ? $order->customer_phone : $order->shipping_phone}}<br>
                Address: {{$order->shipping_address == null ? $order->customer_address : $order->shipping_address}}<br>
{{$order->shipping_city == null ? $order->customer_city : $order->shipping_city}}-{{$order->shipping_zip == null ? $order->customer_zip : $order->shipping_zip}}
                                                                        </address>
                                                                    @endif

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5>Shipping Method</h5>
                                                                    @if($order->shipping == "shipto")
                                                                        <p>Ship To Address</p>
                                                                    @endif
                                                                    @if($order->shipping_cost != 0)
                                                                        @php 
                                                                        $price = round(($order->shipping_cost / $order->currency_value),2);
                                                                        @endphp
                                                                        @if(DB::table('shippings')->where('price','=',$price)->count() > 0)
                                                                <p>
                                                                    {{ DB::table('shippings')->where('price','=',$price)->first()->title }}: {{$order->currency_sign}}{{ round($order->shipping_cost, 2) }}
                                                                </p>
                                                                        @endif
                                                                    @endif

                                                                    @if($order->packing_cost != 0)

                                                                        @php 
                                                                        $pprice = round(($order->packing_cost / $order->currency_value),2);
                                                                        @endphp


                                                                        @if(DB::table('packages')->where('price','=',$pprice)->count() > 0)
                                                                <p>
                                                                    {{ DB::table('packages')->where('price','=',$pprice)->first()->title }}: {{$order->currency_sign}}{{ round($order->packing_cost, 2) }}
                                                                </p>
                                                                        @endif
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="billing-add-area">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h5>Billing Address</h5>
                                                                    <address>
                                                                        Name: {{$order->customer_name}}<br>
                                                                        Email: {{$order->customer_email}}<br>
                                                                        Phone: {{$order->customer_phone}}<br>
                                                                        Address: {{$order->customer_address}}<br>
                                                                        {{$order->customer_city}}-{{$order->customer_zip}}
                                                                    </address>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5>Payment Information</h5>
                                                                    <p>Paid Amount: {{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}</p>
                                                                    <p>Payment Method: {{$order->method}}</p>

                                                                    @if($order->method != "Cash On Delivery")
                                                                        @if($order->method=="Stripe")
                                                                            {{$order->method}} Charge ID: <p>{{$order->charge_id}}</p>
                                                                        @endif
                                                                        @if($order->method=="Paypal")
                                                                        {{$order->method}} Transaction ID: <p id="ttn">{{ isset($_GET['tx']) ? $_GET['tx'] : '' }}</p>
                                                                        @else
                                                                        {{$order->method}} Transaction ID: <p id="ttn">{{$order->txnid}}</p>
                                                                        @endif

                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
@endif
                                                        <br>
                                                        <div class="table-responsive">
                            <table  class="table">
                                <h4 class="text-center">Ordered Products:</h4>
                                <thead>
                                <tr>

                                    <th width="60%">Name</th>
                                    <th width="20%">Details</th>
                                    <th width="10%">Price</th>
                                    <th width="10%">Total</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($tempcart->items as $product)
                                    <tr>

                                            <td>{{ $product['item']['name'] }}</td>
                                            <td>
                                                <b>Quantity</b>: {{$product['qty']}} <br>
                                                @if(!empty($product['size']))
                                                <b>Size</b>: {{ $product['item']['measure'] }}{{str_replace('-',' ',$product['size'])}} <br>
                                                @endif
                                                @if(!empty($product['color']))
                                                <div class="d-flex mt-2">
                                                <b>Color</b>:  <span id="color-bar" style="border: 10px solid #{{$product['color'] == "" ? "white" : $product['color']}};"></span>
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

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
                <!-- Ending of Dashboard data-table area -->
            </div>

@endif
</div>
</div>
  </section>

@endsection