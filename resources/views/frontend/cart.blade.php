@extends('layouts.main-ecommerce')
@section('content')

<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>CART</h2>
                    <nav class="breadcrumb">
                        <ul>
                            <li><a href="{{ route('front.index') }}">home</a></li>
                            <li><a class="disabled" href="{{ route('front.cart') }}">Cart</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner end -->

<!-- Cart start -->
<section class="card-page pt-120 pb-120">
    <div class="container">
        <div class="row cart-row">
        @if(Session::has('cart'))
            <div class="col-lg-8">
                <div class="card-details table-responsive">
                    <table class="table">
                        <thead class="shadow-light">
                          <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col" style="width:110px">Sub Total</th>        
                          </tr>
                        </thead>
                        <tbody>
                        @if(Session::has('cart'))
                          @foreach($products as $product)
                          <tr class="pb-30 pt-30">
                            <td scope="row"><span class="cart-item-remove" data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}"><i class="far fa-trash-alt"></i></span></td>
                            <td><img class="w-100 img-fluid" src="{{ $product['item']['photo'] ? asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" alt=""></td>
                            <td><a href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 35 ? mb_substr($product['item']['name'],0,35,'utf-8').'...' : $product['item']['name']}}</a></td>
                            <td>{{ App\Models\Product::convertPrice($product['item']['price']) }}</td>
                            <td class="counting">
                                <i class="fas fa-minus decrease"></i>
                                <span>{{ $product['qty'] }}</span>
                                <i class="fas fa-plus increase"></i>
                            </td>
                            <td>{{ App\Models\Product::convertPrice($product['price']) }}</td>
                          </tr>
                          @endforeach
                        @endif
                        </tbody>
                      </table>
                </div>
                <div class="card-handle flex-wrap pt-30 pb-30">
                    <div class="form mr-15 mt-30">
                        <form action="" id="apply-coupon" class="oneline-form shadow-light">
                            <input type="text" id="coupon-code" placeholder="enter coupon code" autocomplete="off">
                            <button type="submit">apply coupon</button>
                        </form>
                    </div>
                    <!--
                    <div class="card-handle-btns ml-lg-auto mt-30">
                        <a class="btn white-btn text-capitalize shadow-light" href="#">empty card</a>
                        <a class="btn white-btn text-capitalize ml-10 shadow-light" href="#">update card</a>
                    </div>
                    -->
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card-total">
                    <h3>cart total</h3>
                    <ul class="mt-50 mb-50 card-price-list">
                        <li>
                            <span>Subtotal</span>
                            <span class="cart-total">{{ Session::has('cart') ? App\Models\Product::convertPrice($totalPrice) : '0.00' }}</span>
                        </li>
                        <li>
                            <span>Discount</span>
                            <span class="shopping-discount">{{ App\Models\Product::convertPrice(0)}} <input type="hidden" id="d-val" value="{{ App\Models\Product::convertPrice(0)}}"></span>
                        </li>
                        <li>
                            <span>Tax</span>
                            <span>{{$tx}}%</span>
                        </li>
                        <li class="total">
                            <span>Total</span>
                            <span class="grand-total">{{ Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00' }}</span>
                        </li>
                    </ul>
                    <div class="submission-btns">
                        <a class="btn d-block shadow-light" href="{{ route('front.checkout') }}">Proceed To Checkout</a>
                        <span class="pt-20 pb-20 d-block text-center">or</span>
                        <a class="btn white-btn d-block shadow-light" href="{{ route('front.index') }}">continue shopping</a>
                    </div>
                </div>
            </div>
          @else
          <h3 class="mt-1 pl-3 text-left">No item(s) in Cart.</h3>
          &nbsp;&nbsp;&nbsp;<a class="btn white-btn d-block shadow-light" href="{{ route('front.index') }}">Go to Shop</a>       
          @endif
        </div>
    </div>
</section>
<!-- Cart end -->

@if($gs->is_newsletter== 1)
    <!-- Subscribe start -->
    <section class="subscribe pt-80 pb-80" style="background-image: url({{asset('assets/images/'.$gs->popup_background)}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="subscribe-text">
                        <h2>{{$gs->popup_title}}</h2>
                        <p>{{$gs->popup_text}}
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="subscribe-form h-100 flex left-center">
                        <form action="{{route('front.subscribe')}}" class="flex w-100 shadow-deep">
                            <input type="email" placeholder="Enter your email">
                            <button type="submit">subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Subscribe end -->
@endif
@endsection 

@section('scripts')
<script>
  $(document).on("click", ".cart-item-remove", function(){
    $(this).closest("tr").remove();
    var to = $(this).data("href");
    $.ajax({
      url: to,
      type: "GET",
      dataType: "json",
      success: function(r){
        if(0==r){
          $("#header-cart-btn-count").html(r);
          $(".cart-row").html('<h3 class="mt-1 pl-3 text-left">No item(s) in Cart.</h3>');
          $("#cart-dropdown").html('<p class="mt-1 pl-3 text-left">No item(s) in Cart.</p>');
          $(".cartpage .col-lg-4").html("");
        }else{
          $(".cart-quantity").html(r[1]);
          $(".cart-total").html(r[0]);
          $(".coupon-total").val(r[0]);
          $(".grand-total").html(r[3]);
        }
      }
    });    
  });

  $("#apply-coupon").on("submit",function(e){
    e.preventDefault();  
    var current_url = window.location;
    var code = $("#coupon-code").val();
    var grand_total = $(".grand-total").html();
    return $.ajax({
        type:"GET",
        url:current_url+"/coupon",
        data:{code:code, total:grand_total},
        success:function(result){
                if(result == 0){
                    $("#coupon-code").val("");
                }else if(result == 2){
                    $("#coupon-code").val("");
                }else{
                    $(".grand-total").html(result[0]);
                    $(".shopping-discount").html(result[4]);
                    $("#coupon-code").val("");
                }
            }
        }),!1
    })


</script>
@endsection