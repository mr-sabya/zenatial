@extends('layouts.main-ecommerce')

@section('styles')

<style type="text/css">
	
	    .root.root--in-iframe {
      background: #4682b447 !important;
    }
</style>

@endsection



@section('content')
<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="banner-text">
					<h2>Checkout Page</h2>
					<nav class="breadcrumb">
						<ul>
							<li><a href="{{ route('front.index') }}">home</a></li>
							<li><a href="{{ route('front.cart') }}">Cart</a></li>
							<li><a class="disabled" href="javascript:;">Checkout</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Banner end -->

<!-- Checkout start -->
<section class="checkout pt-120 pb-120">
	<div class="container">
		<form id="checkoutform" action="{{ route('front.index') }}/cashondelivery" method="POST" class="checkoutform" novalidate>
			{{ csrf_field() }}
			<div class="basic-form">
				<div class="row">
					<div class="col-lg-8">
						<div class="billing-details">
							<p class="running-customer">Returning Customer? <a href="{{ route('user.login') }}">Click here to login</a></p>
							<h2 class="text-uppercase mb-4">billing details</h2>
								<div class="row">
									<div class="col-lg-6 ">
										<input name="name" type="text" class="form-control" placeholder="Name*" value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->name : '' }}" required>
										<div class="invalid-feedback">
											Please provide a valid name.
										</div>
									</div>
									<div class="col-lg-6">
										<input type="text" name="address" class="form-control" placeholder="Address*" required="" value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->address : '' }}">
										<div class="invalid-feedback">
											Please provide a valid address.
										</div>
									</div>
									<div class="col-lg-6">
										<input type="text" class="form-control" placeholder="Company" value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->company : '' }}">
										<div class="invalid-feedback">
										</div>
									</div>
									<div class="col-lg-6">
										<input type="email" name="email" class="form-control" placeholder="Email*" required="" value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->email : '' }}">
										<div class="invalid-feedback">
											Please provide a valid email.
										</div>
									</div>
									<div class="col-lg-6">
										<input name="phone" type="text" class="form-control" placeholder="Mobile*" value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->phone : '' }}" required>
										<div class="invalid-feedback">
											Please provide a valid phone number.
										</div>
									</div>
									<div class="col-lg-6">
										<input name="city" type="text" class="form-control" placeholder="City/State*" required="" value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->city : '' }}">
										<div class="invalid-feedback">
											Please provide a valid city.
										</div>
									</div>
									<div class="col-lg-6">
										<input name="customer_country" type="text" class="form-control" placeholder="Country*" value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->country : '' }}">
										<div class="invalid-feedback">
											Please provide a valid country.
										</div>
									</div>
									<div class="col-lg-6">
										<input name="zip" type="text" class="form-control" placeholder="Zip*" required="" value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->zip : '' }}">
										<div class="invalid-feedback">
											Please provide a valid ZIP code.
										</div>
									</div>
									<div class="col-lg-12">
										<input type="text" class="form-control" name="order_notes" placeholder="Order Note (Optional)">
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<div class="form-check">
											@if(!Auth::check())
												<input class="form-check-input" type="checkbox" id="create-account">
												<label class="form-check-label mr-25" for="create-account">
													Create a account
												</label>											
											@endif
												<input class="form-check-input" type="checkbox" id="shipping-address">
												<label class="form-check-label" for="shipping-address">
													Ship to difference address
												</label>
											</div>
										</div>
									</div>								
								</div>
								<div class="row create-account-password d-none">
									<div class="col-lg-6">
										<input type="password" name="personal_pass" id="personal-pass" class="form-control" placeholder="Password">
									</div>
									<div class="col-lg-6">
										<input type="password" name="personal_confirm" id="personal-pass-confirm" class="form-control" placeholder="Confirm Password">
									</div>
									<hr>
								</div>							
								<div class="row shipping-to-different-address d-none">
									<div class="col-lg-6 ">
										<input name="shipping_name" type="text" class="form-control" placeholder="Name*" required="">
										<div class="invalid-feedback">
											Please provide a valid name.
										</div>
									</div>
									<div class="col-lg-6">
										<input type="text" name="shipping_address" class="form-control" placeholder="Address*" value="">
										<div class="invalid-feedback">
											Please provide a valid address.
										</div>
									</div>
									<div class="col-lg-6">
										<input type="text" class="form-control" placeholder="Company" value="">
										<div class="invalid-feedback">
										</div>
									</div>
									<div class="col-lg-6">
										<input type="email" name="shipping_email" class="form-control" placeholder="Email*" required="" value="">
										<div class="invalid-feedback">
											Please provide a valid email.
										</div>
									</div>
									<div class="col-lg-6">
										<input name="shipping_phone" type="text" class="form-control" placeholder="Mobile*" value="" required>
										<div class="invalid-feedback">
											Please provide a valid phone number.
										</div>
									</div>
									<div class="col-lg-6">
										<input name="shipping_city" type="text" class="form-control" placeholder="City/State*" required value="">
										<div class="invalid-feedback">
											Please provide a valid city.
										</div>
									</div>
									<div class="col-lg-6">
										<input name="shipping_country" type="text" class="form-control" placeholder="Country*" required value="">
										<div class="invalid-feedback">
											Please provide a valid country.
										</div>
									</div>
									<div class="col-lg-6">
										<input name="shipping_zip" type="text" class="form-control" placeholder="Zip*" required="" value="">
										<div class="invalid-feedback">
											Please provide a valid ZIP code.
										</div>
									</div>
								</div>
								<input type="hidden" name="method" value="Cash On Delivery">
								<input type="hidden" id="shipping-cost" name="shipping_cost" value="{{ $default_shipping_cost }}">
								<input type="hidden" name="tax" value="{{$gs->tax}}">
								<input type="hidden" name="totalQty" value="{{$totalQty}}">

								@if(Session::has('coupon_total'))
									<input type="hidden" name="total" id="grandtotal" value="{{ $totalPrice }}">
									<input type="hidden" id="tgrandtotal" value="{{ $totalPrice }}">
								@elseif(Session::has('coupon_total1'))
									<input type="hidden" name="total" id="grandtotal" value="{{ preg_replace("/[^0-9,.]/", "", Session::get('coupon_total1') ) }}">
									<input type="hidden" id="tgrandtotal" value="{{ preg_replace("/[^0-9,.]/", "", Session::get('coupon_total1') ) }}">
								@else
									<input type="hidden" name="total" id="grandtotal" value="{{round($totalPrice * $curr->value,2)}}">
									<input type="hidden" id="tgrandtotal" value="{{round($totalPrice * $curr->value,2)}}">
								@endif
								<input type="hidden" name="coupon_code" id="coupon_code" value="{{ Session::has('coupon_code') ? Session::get('coupon_code') : '' }}">
								<input type="hidden" name="coupon_discount" id="coupon_discount" value="{{ Session::has('coupon') ? Session::get('coupon') : '' }}">
								<input type="hidden" name="coupon_id" id="coupon_id" value="{{ Session::has('coupon') ? Session::get('coupon_id') : '' }}">
								<input type="hidden" name="user_id" id="user_id" value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->id : '' }}">														
							</from>
						</div>
					</div>
					<div class="col-lg-4">
						<h3>order details</h3>
						<ul class="mt-50 mb-50 card-price-list">
							<li class="list-title pb-20">
								<span>Products</span>
								<span>Total</span>
							</li>
							<li>
								<span>Subtotal</span>
								<span class="cart-total">{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}</span>
							</li>
							<li>
								<span>Shipping</span>
								<span class="shipping-cost-in-details-area">+{{ $curr->sign }}{{ $default_shipping_cost }}</span>
							</li>
							<li>
								<span>Discount</span>
								<span class="shopping-discount">
								@if(Session::has('coupon'))
									@if($gs->currency_format == 0)
										<b id="discount">-{{ $curr->sign }}{{ Session::get('coupon') }}</b>
									@else 
										<b id="discount">-{{ Session::get('coupon') }}{{ $curr->sign }}</b>
									@endif
								@else
									<b id="discount">-{{ $curr->sign }}0</b>
								@endif
								</span>
							</li>
							<li class="total">
								<span>Total</span>
								<span class="grand-total">
									@if(Session::has('coupon_total'))
										{{ $curr->sign }}{{ $totalPrice }}
									@elseif(Session::has('coupon_total1'))
										{{ $curr->sign }}{{ preg_replace("/[^0-9,.]/", "", Session::get('coupon_total1') ) }}
									@else
										{{ $curr->sign }}{{round($totalPrice * $curr->value,2)}}
									@endif							
								</span>
							</li>
						</ul>
						<h6 class="text-capitalize pb-10 mt-30">Shipping Option*</h6>
						<div class="form-group">
							<select class="custom-select shadow-light shipping-option">
							@foreach($shipping_data as $data)
								<option value="{{ round($data->price * $curr->value,2) }}">{{ $data->title }} {{ $data->subtitle }} 									
								@if($data->price != 0)
									- (+{{ $curr->sign }}{{ round($data->price * $curr->value,2) }})
								@endif
								</option>
							@endforeach
							</select>
							<div class="invalid-feedback">Example invalid custom select feedback</div>
						</div>

						<h6 class="text-capitalize pb-10 mt-30">Payment method*</h6>

						<div class="accordion" id="payment-collapse">
							@foreach($gateways as $gt)
							<!--
								<div class="card">
									<div class="card-header">
										<div class="form-check">
											<input class="form-check-input" type="radio" name="payment" id="{{ strtolower(str_replace(' ', '-', $gt->title)) }}" value="option1" data-toggle="collapse" data-target="#{{ strtolower(str_replace(' ', '-', $gt->title)) }}-collapse">
											<label class="form-check-label" for="{{ strtolower(str_replace(' ', '-', $gt->title)) }}">{{ $gt->title }}</label>
										</div>
									</div>
									<div id="{{ strtolower(str_replace(' ', '-', $gt->title)) }}-collapse" class="collapse mb-0" data-parent="#payment-collapse">
										<div class="card-body">
											<p>{{ $gt->subtitle }}</p>
										</div>
									</div>
								</div>
							-->
							@endforeach
							@if($gs->cod_check == 1)
								<div class="card">
									<div class="card-header">
										<div class="form-check">
											<input class="form-check-input payment-option" type="radio" name="payment" id="cash-on-delivery" value="option1" checked data-name="Cash On Delivery" data-toggle="collapse" data-target="#cash-on-delivery-collapse">
											<label class="form-check-label" for="cash-on-delivery">Cash On Delivery</label>
										</div>
									</div>

									<div id="cash-on-delivery-collapse" class="collapse mb-0" data-parent="#payment-collapse">
										<div class="card-body">
											<p>Pay with Cash Upon Delivery.</p>
										</div>
									</div>
								</div>
							@endif
							@if($gs->bkash_check == 1)
								<div class="card">
									<div class="card-header">
										<div class="form-check">
											<input class="form-check-input payment-option" type="radio" name="payment" id="bkash" value="option1" data-name="bKash" data-toggle="collapse" data-target="#bkash-collapse">
											<label class="form-check-label" for="bkash">bKash</label>
										</div>
									</div>

									<div id="bkash-collapse" class="collapse mb-0" data-parent="#payment-collapse">
										<div class="card-body">
											<p>{!! $gs->bkash_text !!}</p>
											<div class="form-group">
												<input type="text" name="transaction_id" class="form-control" placeholder="Transaction ID" disabled />
											</div>
										</div>
									</div>
								</div>
							@endif
						</div>
						<div class="order-submission mt-30">
							<input type="submit" class="btn w-100" value="Place your order">
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>
<!-- Checkout end -->

<style>
.form-check-input[type='radio']{
	margin-top: -13px;
}
</style>
@endsection

@section('scripts')
<script type="text/javascript">

	$("body").on("click", "#shipping-address", function(){
		if($(this).is(':checked')){
			$(".shipping-to-different-address").removeClass('d-none');
		}else{
			$(".shipping-to-different-address").addClass('d-none');
		}
	});
	$("body").on("click", "#create-account", function(){
		if($(this).is(':checked')){
			$(".create-account-password").removeClass('d-none');
		}else{
			$(".create-account-password").addClass('d-none');
		}
	});

	$(".shipping-option").on("change", function(){
		val = $(this).val();
		$('#shipping-cost').val(val);
		$('.shipping-cost-in-details-area').html("+" + "{{ $curr->sign }}" + "" + val);
		
		var ttotal = parseFloat($('#tgrandtotal').val()) + parseFloat(val);
		ttotal = parseFloat(ttotal);
		$('#grandtotal').val(ttotal);
		$('.grand-total').html("{{ $curr->sign }}" + "" + ttotal);
	});

	$("body").on('click', '#payment-collapse .payment-option', function(){
		let name = $(this).data('name');
		$('input[name="method"]').val(name);

		if(name='bKash'){
			$('input[name="transaction_id"]').prop('disabled', false);
			$('input[name="transaction_id"]').prop('required', true);
		}
	});
</script>
@endsection