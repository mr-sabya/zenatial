@extends('layouts.vendor')

@section('pageheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
                All Orders
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h4>Order Details</h4>
                <table>
                    <tbody>
                    <tr>
                        <th>Order ID</th>
                        <td>:</td>
                        <td>{{$order->order_number}}</td>
                    </tr>
                    <tr>
                        <th>Total Product</th>
                        <td>:</td>
                        <td>{{$order->totalQty}}</td>
                    </tr>
                    @if($order->shipping_cost != 0)
                    @php 
                    $price = round(($order->shipping_cost / $order->currency_value),2);
                    @endphp
                    @if(DB::table('shippings')->where('price','=',$price)->count() > 0)
                    <tr>
                        <th>{{ DB::table('shippings')->where('price','=',$price)->first()->title }}</th>
                        <td>:</td>
                        <td>{{ $order->currency_sign }}{{ round($order->shipping_cost, 2) }}</td>
                    </tr>
                    @endif
                    @endif
                    @if($order->packing_cost != 0)
                    @php 
                    $pprice = round(($order->packing_cost / $order->currency_value),2);
                    @endphp
                    @if(DB::table('packages')->where('price','=',$pprice)->count() > 0)
                    <tr>
                        <th>{{ DB::table('packages')->where('price','=',$pprice)->first()->title }}</th>
                        <td>:</td>
                        <td>{{ $order->currency_sign }}{{ round($order->packing_cost, 2) }}</td>
                    </tr>
                    @endif
                    @endif

                    <tr>
                        <th>Total Cost</th>
                        <td>:</td>
                        <td>{{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}</td>
                    </tr>
                    <tr>
                        <th>Ordered Date</th>
                        <td>:</td>
                        <td>{{date('d-M-Y H:i:s a',strtotime($order->created_at))}}</td>
                    </tr>
                    <tr>
                        <th>Payment Method</th>
                        <td>:</td>
                        <td>{{$order->method}}</td>
                    </tr>

                    @if($order->method != "Cash On Delivery")
                    @if($order->method=="Stripe")
                    <tr>
                        <th>{{$order->method}} Charge ID</th>
                        <td>:</td>
                        <td>{{$order->charge_id}}</td>
                    </tr>                        
                    @endif
                    <tr>
                        <th>{{$order->method}} Transaction ID</th>
                        <td>:</td>
                        <td>{{$order->txnid}}</td>
                    </tr>                         
                    @endif

                    <tr>
                        <th>Payment Status</th>
                        <th>:</th>
                        <td>{!! $order->payment_status == 'Pending' ? "<span class='badge badge-danger'>Unpaid</span>":"<span class='badge badge-success'>Paid</span>" !!}</td>
                    </tr>
                    <tr>
                        <td colspan=3><a href="{{ route('admin-order-invoice',$order->id) }}" class="btn btn-primary mt-3"><i class="fas fa-eye"></i> {{ __('View Invoice') }}</a></td>
                    </tr>  
                    @if(!empty($order->order_note))
                    <tr>
                        <th>Order Note</th>
                        <th>:</th>
                        <td>{{$order->order_note}}</td>
                    </tr>  
                    @endif

                    </tbody>
                </table>           
            </div>
            <div class="col-md-4">
                <h4>Billing Details</h4>
                <table>
                    <tbody>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>:</th>
                            <td>{{$order->customer_name}}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Email') }}</th>
                            <th>:</th>
                            <td>{{$order->customer_email}}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Phone') }}</th>
                            <th>:</th>
                            <td>{{$order->customer_phone}}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Address') }}</th>
                            <th>:</th>
                            <td>{{$order->customer_address}}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Country') }}</th>
                            <th>:</th>
                            <td>{{$order->customer_country}}</td>
                        </tr>
                        <tr>
                            <th>{{ __('City') }}</th>
                            <th>:</th>
                            <td>{{$order->customer_city}}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Postal Code') }}</th>
                            <th>:</th>
                            <td>{{$order->customer_zip}}</td>
                        </tr>
                        @if($order->coupon_code != null)
                        <tr>
                            <th>{{ __('Coupon Code') }}</th>
                            <th>:</th>
                            <td>{{$order->coupon_code}}</td>
                        </tr>
                        @endif
                        @if($order->coupon_discount != null)
                        <tr>
                            <th>{{ __('Coupon Discount') }}</th>
                            <th>:</th>
                            @if($gs->currency_format == 0)
                            <td>{{ $order->currency_sign }}{{ $order->coupon_discount }}</td>
                            @else 
                            <td>{{ $order->coupon_discount }}{{ $order->currency_sign }}</td>
                            @endif
                        </tr>
                        @endif
                        @if($order->affilate_user != null)
                        <tr>
                            <th>{{ __('Affilate User') }}</th>
                            <th>:</th>
                            <td>{{$order->affilate_user}}</td>
                        </tr>
                        @endif
                        @if($order->affilate_charge != null)
                        <tr>
                            <th>{{ __('Affilate Charge') }}</th>
                            <th>:</th>
                            @if($gs->currency_format == 0)
                            <td>{{ $order->currency_sign }}{{$order->affilate_charge}}</td>
                            @else 
                            <td>{{$order->affilate_charge}}{{ $order->currency_sign }}</td>
                            @endif
                        </tr>
                        @endif
                    </tbody>
                </table>            
            </div>
            <div class="col-md-4">
                <h4>Shipping Details</h4>
                <table>
                    <tbody>
                        <tr>
                            <th width="45%"><strong>{{ __('Name') }}:</strong></th>
                            <th width="10%">:</th>
                            <td>{{$order->shipping_name == null ? $order->customer_name : $order->shipping_name}}</td>
                        </tr>
                        <tr>
                            <th width="45%"><strong>{{ __('Email') }}:</strong></th>
                            <th width="10%">:</th>
                            <td width="45%">{{$order->shipping_email == null ? $order->customer_email : $order->shipping_email}}</td>
                        </tr>
                        <tr>
                            <th width="45%"><strong>{{ __('Phone') }}:</strong></th>
                            <th width="10%">:</th>
                            <td width="45%">{{$order->shipping_phone == null ? $order->customer_phone : $order->shipping_phone}}</td>
                        </tr>
                        <tr>
                            <th width="45%"><strong>{{ __('Address') }}:</strong></th>
                            <th width="10%">:</th>
                            <td width="45%">{{$order->shipping_address == null ? $order->customer_address : $order->shipping_address}}</td>
                        </tr>
                        <tr>
                            <th width="45%"><strong>{{ __('Country') }}:</strong></th>
                            <th width="10%">:</th>
                            <td width="45%">{{$order->shipping_country == null ? $order->customer_country : $order->shipping_country}}</td>
                        </tr>
                        <tr>
                            <th width="45%"><strong>{{ __('City') }}:</strong></th>
                            <th width="10%">:</th>
                            <td width="45%">{{$order->shipping_city == null ? $order->customer_city : $order->shipping_city}}</td>
                        </tr>
                        <tr>
                            <th width="45%"><strong>{{ __('Postal Code') }}:</strong></th>
                            <th width="10%">:</th>
                            <td width="45%">{{$order->shipping_zip == null ? $order->customer_zip : $order->shipping_zip}}</td>
                        </tr>
                    </tbody>
                </table>                       
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        Product Details
    </div>
    <div class="card-body">
        <table id="example2" class="table table-hover dt-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                <tr>
                    <th width="10%">{{ __('Product ID#') }}</th>
                    <th>{{ __('Shop Name') }}</th>
                    <th>{{ __('Vendor Status') }}</th>
                    <th>{{ __('Product Title') }}</th>
                    <th width="20%">{{ __('Details') }}</th>
                    <th width="10%">{{ __('Total Price') }}</th>
                </tr>
                </tr>
            </thead>
            <tbody>
                @foreach($cart->items as $key => $product)
                <tr>
                    <td><input type="hidden" value="{{$key}}">{{ $product['item']['id'] }}</td>
                    <td>
                        @if($product['item']['user_id'] != 0)
                        @php
                        $user = App\Models\User::find($product['item']['user_id']);
                        @endphp
                        @if(isset($user))
                        <a target="_blank" href="{{route('admin-vendor-show',$user->id)}}">{{$user->shop_name}}</a>
                        @else
                        {{ __('Vendor Removed') }}
                        @endif
                        @else 
                        <a  href="javascript:;">{{ App\Models\Admin::find(1)->shop_name }}</a>
                        @endif
                    </td>
                    <td>
                        @if($product['item']['user_id'] != 0)
                        @php
                        $user = App\Models\VendorOrder::where('order_id','=',$order->id)->where('user_id','=',$product['item']['user_id'])->first();
                        @endphp
                        @if($order->dp == 1 && $order->payment_status == 'Completed')
                        <span class="badge badge-success">{{ __('Completed') }}</span>
                        @else
                        @if($user->status == 'pending')
                        <span class="badge badge-warning">{{ucwords($user->status)}}</span>
                        @elseif($user->status == 'processing')
                        <span class="badge badge-info">{{ucwords($user->status)}}</span>
                        @elseif($user->status == 'on delivery')
                        <span class="badge badge-primary">{{ucwords($user->status)}}</span>
                        @elseif($user->status == 'completed')
                        <span class="badge badge-success">{{ucwords($user->status)}}</span>
                        @elseif($user->status == 'declined')
                        <span class="badge badge-danger">{{ucwords($user->status)}}</span>
                        @endif
                        @endif
                        @endif
                    </td>
                    <td>
                        <input type="hidden" value="{{ $product['license'] }}">
                        @if($product['item']['user_id'] != 0)
                        @php
                        $user = App\Models\User::find($product['item']['user_id']);
                        @endphp
                        @if(isset($user))
                        {{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}
                        @else
                        {{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}
                        @endif
                        @else 
                        {{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}
                        @endif
                        @if($product['license'] != '')
                        <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete" class="btn btn-info product-btn" id="license" style="padding: 5px 12px;"><i class="fa fa-eye"></i> {{ __('View License') }}</a>
                        @endif
                    </td>
                    <td>
                        @if($product['size'])
                        <p>
                            <strong>{{ __('Size') }} :</strong> {{str_replace('-',' ',$product['size'])}}
                        </p>
                        @endif
                        @if($product['color'])
                        <p>
                            <strong>{{ __('color') }} :</strong> <span
                                style="width: 40px; height: 20px; display: block; background: #{{$product['color']}};"></span>
                        </p>
                        @endif
                        <p>
                            <strong>{{ __('Price') }} :</strong> {{$order->currency_sign}}{{ round($product['item']['price'] * $order->currency_value , 2) }}
                        </p>
                        <p>
                            <strong>{{ __('Qty') }} :</strong> {{$product['qty']}} {{ $product['item']['measure'] }}
                        </p>
                        @if(!empty($product['keys']))
                        @foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values']))  as $key => $value)
                        <p>
                            <b>{{ ucwords(str_replace('_', ' ', $key))  }} : </b> {{ $value }} 
                        </p>
                        @endforeach
                        @endif
                    </td>
                    <td>{{$order->currency_sign}}{{ round($product['price'] * $order->currency_value , 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>       
    </div>
</div>
@endsection