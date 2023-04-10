@extends('layouts.vendor')

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                Invoice
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
<!-- Main content -->
<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
    <div class="col-12">
        <h4>
        <img src="{{ asset('assets/images/'.$gs->invoice_logo) }}">
        <small class="float-right">Order Date: {{ date('d-M-Y',strtotime($order->created_at)) }}</small>
        </h4>
    </div>
    <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
        Shipping Address
        <address>
        <strong>{{ $order->shipping_name == null ? $order->customer_name : $order->shipping_name}}</strong><br>
        {{ $order->shipping_address == null ? $order->customer_address : $order->shipping_address }}<br>
        City</strong>: {{ $order->shipping_city == null ? $order->customer_city : $order->shipping_city }}<br>
        {{ $order->shipping_country == null ? $order->customer_country : $order->shipping_country }}<br>
        Phone: {{ $order->shipping_phone == null ? $order->customer_phone : $order->shipping_phone }}<br>
        Email: {{ $order->shipping_email == null ? $order->customer_email : $order->shipping_email }}<br>
        </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
        Billing Details
        <address>
        <strong>{{ $order->customer_name}}</strong><br>
        {{ $order->customer_address }}<br>
        {{ $order->customer_city }}<br>
        {{ $order->customer_country }}<br>
        Phone: {{ $order->customer_phone }}<br>
        Email: {{ $order->customer_email }}
        </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
        <b>Invoice #{{ sprintf("%'.08d", $order->id) }}</b><br>
        <br>
        <b>Order ID:</b> {{ $order->order_number }}<br>
        <b>Payment Method:</b> {{$order->method}}
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped">
        <thead>
        <tr>
            <th>Qty</th>
            <th>Product</th>
            <th>Details</th>
            <th>Unit Price</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        @php
        $subtotal = 0;
        $tax = 0;
        @endphp
        @foreach($cart->items as $product)
            <tr>
                <td>{{$product['qty']}} {{ $product['item']['measure'] }}</td>
                <td>
                    @if($product['item']['user_id'] != 0)
                        @php
                        $user = App\Models\User::find($product['item']['user_id']);
                        @endphp
                        @if(isset($user))
                        {{ $product['item']['name']}}
                        @else
                        {{$product['item']['name']}}
                        @endif

                        @else
                        {{ $product['item']['name']}}

                    @endif                
                </td>
                <td>
                    @if($product['size'])
                        <p>
                            <strong>Size :</strong> {{str_replace('-',' ',$product['size'])}}
                        </p>
                        @endif
                        @if($product['color'])
                        <p>
                            <strong>color :</strong> <span style="width: 40px; height: 20px; display: block; background: #{{$product['color']}};"></span>
                        </p>
                    @endif                
                </td>
                <td>
                    {{$order->currency_sign}}{{ round($product['item']['price'] * $order->currency_value , 2) }}                
                </td>
                <td>{{$order->currency_sign}}{{ round($product['price'] * $order->currency_value , 2) }}</td>
                @php
                $subtotal += round($product['price'] * $order->currency_value, 2);
                @endphp
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
    <!-- accepted payments column -->
    <div class="col-6 no-print">
        <p class="lead"><a href="{{route('admin-order-print',$order->id)}}" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a></p>
        </p>
    </div>
    <!-- /.col -->
    <div class="col-6">
        <div class="table-responsive">
        <table class="table">
            <tr>
                <td></td>
                <td></td>
                <td>Subtotal</td>
                <td>{{$order->currency_sign}}{{ round($subtotal, 2) }}</td>
            </tr>
            @if($order->shipping_cost != 0)
            @php 
            $price = round(($order->shipping_cost / $order->currency_value),2);
            @endphp
                @if(DB::table('shippings')->where('price','=',$price)->count() > 0)
                <tr>
                    <td></td>
                    <td></td>
                    <td>{{ DB::table('shippings')->where('price','=',$price)->first()->title }}({{$order->currency_sign}})</td>
                    <td>{{ round($order->shipping_cost , 2) }}</td>
                </tr>
                @endif
            @endif

            @if($order->packing_cost != 0)
            @php 
            $pprice = round(($order->packing_cost / $order->currency_value),2);
            @endphp
            @if(DB::table('packages')->where('price','=',$pprice)->count() > 0)
            <tr>
                <td></td>
                <td></td>
                <td>{{ DB::table('packages')->where('price','=',$pprice)->first()->title }}({{$order->currency_sign}})</td>
                <td>{{ round($order->packing_cost , 2) }}</td>
            </tr>
            @endif
            @endif

            @if($order->tax != 0)
            <tr>
                <td></td>
                <td></td>
                <td>TAX({{$order->currency_sign}})</td>
                @php
                $tax = ($subtotal / 100) * $order->tax;
                @endphp
                <td>{{round($tax, 2)}}</td>
            </tr>
            @endif
            @if($order->coupon_discount != null)
            <tr>
                <td></td>
                <td></td>
                <td>Coupon Discount({{$order->currency_sign}})</td>
                <td>{{round($order->coupon_discount, 2)}}</td>
            </tr>
            @endif
            <tr>
                <td></td>
                <td></td>
                <td>Total</td>
                <td>{{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}
                </td>
            </tr>
        </table>
        </div>
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.invoice -->
@endsection