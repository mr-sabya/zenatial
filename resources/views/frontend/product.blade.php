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
					<h2>Product Details</h2>
					<nav class="breadcrumb">
						<ul>
							<li><a href="{{ route('front.index') }}">home</a></li>
							<li><a class="disabled" href="javascript:;">{{ $productt->name }}</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Banner end -->

    <!-- Shop product details start -->
    <main class="shop-product-details pt-120 pb-120">
        <div class="container">
            <div class="details-content" id="product-preview">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="img-gallery h-100">
                            <img class="w-100 img-fluid view-area" id="product-img" src="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}" data-zoom-image="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}" alt="product img">
                            <div id="img-gallery" class="flex">
                                <a class="active" href="#" data-image="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}" data-zoom-image="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}">
                                    <img class="product-img" src="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}" alt="product img">
                                </a>
                              @foreach($productt->galleries as $gal)
                                <a href="#" data-image="{{asset('assets/images/galleries/'.$gal->photo)}}" data-zoom-image="{{asset('assets/images/galleries/'.$gal->photo)}}">
                                    <img class="product-img" src="{{asset('assets/images/galleries/'.$gal->photo)}}" alt="product img">
                                </a>
                              @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-content">
                            <h4>{{ $productt->name }}</h4>
                            <div class="price-rating flex left-bottom">
                                <div class="pricing">
                                    <span class="price">{{ $productt->showPrice() }}</span>
                                    <span class="discount ml-20">{{ $productt->showPreviousPrice() }}</span>
                                    <?php 
                                    //$difference = ($productt->showPreviousPrice() - $productt->showPrice());
                                    //$discount = ($difference * 100) / $productt->showPreviousPrice();
                                    ?>
                                </div>
                                <div class="rating flex ml-auto">
                                    <div class="stars"></div>
                                    <div class="stars-count">({{count($productt->ratings)}})</div>
                                </div>
                            </div>
                            <p class="product-details mt-30">{!! $productt->details !!}</p>

                            <ul>                                                                                                             
                            @if(!empty($productt->color))
                            <ul class="color flex left-center mt-30">
                                <li class="mr-10">Color: </li>
                                <?php 
                                $i = 0;
                                ?>
                                @foreach($productt->color as $key => $data1)
                                <li>
                                    <input type="radio" class="product_color" <?php echo $i == 0 ? 'checked' : '';  ?> name="color" value="{{ $productt->color[$key] }}" >
                                    <label for="{{ $productt->color[$key] }}" style="background-color:{{ $productt->color[$key] }}"></label>
                                </li> 
                                <?php 
                                $i++;
                                ?>
                                @endforeach                                                               
                            </ul>
                            @endif
                            @if(!empty($productt->size))
                            <ul class="size flex left-center mt-30">
                                <li class="mr-10">Size</li>
                                <?php 
                                $i = 0;
                                ?>
                                @foreach($productt->size as $key => $data1)                                
                                <li>
                                    <input class="product_size" type="radio" name="product_size" <?php echo $i == 0 ? 'checked' : '';  ?> value="{{ $data1 }}">
                                    <label for="{{$data1}}">{{$data1}}</label>
                                    <input type="hidden" class="size" value="{{ $data1 }}">
                                    <input type="hidden" class="size_qty" value="{{ $productt->size_qty[$key] }}">
                                    <input type="hidden" class="size_key" value="{{$key}}">
                                    <input type="hidden" class="size_price" value="{{ round($productt->size_price[$key] * $curr->value,2) }}">                                    
                                </li>
                                <?php 
                                $i++;
                                ?>
                                @endforeach
                            </ul>                          
                            @endif
                            <ul>
                            @if (!empty($productt->attributes))
                            @php
                            $attrArr = json_decode($productt->attributes, true);
                            @endphp
                            @endif
                            @if (!empty($attrArr))
                                <div class="product-attributes my-4">
                                <div class="row">
                                @foreach ($attrArr as $attrKey => $attrVal)
                                    @if (array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1)

                                <div class="col-lg-6">
                                    <div class="form-group mb-2">
                                        <strong for="" class="text-capitalize">{{ str_replace("_", " ", $attrKey) }} :</strong>
                                        <div class="">
                                        @foreach ($attrVal['values'] as $optionKey => $optionVal)
                                        <div class="custom-control custom-radio">
                                            <input type="hidden" class="keys" value="">
                                            <input type="hidden" class="values" value="">
                                            <input type="radio" id="{{$attrKey}}{{ $optionKey }}" name="{{ $attrKey }}" class="custom-control-input product-attr"  data-key="{{ $attrKey }}" data-price = "{{ $attrVal['prices'][$optionKey] * $curr->value }}" value="{{ $optionVal }}" {{ $loop->first ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="{{$attrKey}}{{ $optionKey }}">{{ $optionVal }}

                                            @if (!empty($attrVal['prices'][$optionKey]))
                                            +
                                            {{$curr->sign}} {{$attrVal['prices'][$optionKey] * $curr->value}}
                                            @endif
                                            </label>
                                        </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                                    @endif
                                @endforeach
                                </div>
                                </div>
                            @endif                            
                            </ul>
                            <ul class="brand mt-30">
                                <?php
                                if($productt->childcategory_id != null){
                                ?>
                                <li><span>Category:</span> <?php $result = App\Models\Childcategory::where('id','=',$productt->childcategory_id)->get(); echo $result[0]->name; ?></li>
                                <?php 
                                }elseif($productt->subcategory_id != null){
                                ?>
                                <li><span>Category:</span> <?php $result = App\Models\Subcategory::where('id','=',$productt->subcategory_id)->get(); echo $result[0]->name; ?></li>
                                <?php 
                                }elseif($productt->category_id != null){
                                ?>
                                <li><span>Category:</span> <?php $result = App\Models\Category::where('id','=',$productt->category_id)->get(); echo $result[0]->name; ?></li>
                                <?php 
                                }
                                ?>
                                <li><span>SKU:</span> {{  $productt->sku }}</li>
                            </ul>
                            <div class="item-count flex left-center mt-30">
                                @if($productt->emptyStock())
                                    <label class="btn">Out of Stock</label>
                                @else
                                    <div class="count">
                                        <i class="fas fa-minus decrease"></i>
                                        <span>1</span>
                                        <i class="fas fa-plus increase"></i>
                                    </div>                                
                                    <a href="javascript:;" class="btn" id="addcrt">add to cart</a>
                                @endif                                
                            </div>
                            <input type="hidden" id="product_price" value="{{ round($productt->vendorPrice() * $curr->value,2) }}">
                            <input type="hidden" id="product_id" data-href="{{ route('product.addnumcart') }}" value="{{ $productt->id }}">
                            <input type="hidden" id="curr_pos" value="{{ $gs->currency_format }}">
                            <input type="hidden" id="curr_sign" value="{{ $curr->sign }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-description pt-50">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Return Policy</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Review</a>
                    </li>
                  </ul>
                  <div class="tab-content mt-30" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">{!! $productt->details !!}</div>
                    <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">{!! $productt->policy !!}</div>
                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                        <p>Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Vivamus bibendum magna Lorem ipsum dolor sit amet, consectetur adipiscing elit.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
                        <p>Lorem Ipsum et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident,</p>
                        <p>Lorem Ipsum et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                    </div>
                  </div>
            </div>
                <!-- related start -->
    <div class="related pb-120 pt-120">
        <div class="container">
            <div class="section-title">
                <h2 class="title-text">Releted collection</h2>
                <img src="{{ asset('assets/front/img/section-title.png') }}" alt="after title">
            </div>
            <div class="row">
                @foreach($productt->category->products()->where('status','=',1)->where('id','!=',$productt->id)->take(8)->get() as $prod)
                @include('includes.product.grid-product')
                @endforeach
            </div>
        </div>
    </div>
    <!-- related end -->
        </div>
    </main>
    <!-- Shop product details end -->
    @include('includes.product.quickview')
    <style>
#product-preview .product-content .size li input,
#product-preview .product-content .color li input {
    display: block;
    position: absolute;
    top: 0;
    width: 35px;
    height: 35px;
    opacity: 0;
    cursor: pointer;    
}       
    </style>
@endsection

@section('scripts')
<script src="{{ asset('assets/front/js/jquery.elevatezoom.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
    // Product img preview;
    $("#product-img").elevateZoom({
        gallery: 'img-gallery',
        cursor: 'pointer',
        galleryActiveClass: 'active',
        zoomType: "inner",
        loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif',
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 500,
        lensFadeIn: 500,
        lensFadeOut: 500,
        easing: true,
    });
    var elem = $(".product-details");
    if(elem){
        if (elem.text().length > 10)
                elem.text(elem.text().substr(0,10))
    }  
    // Customer rating;
    $(".stars").rateYo({
        rating: {{count($productt->ratings)}},
        halfStar: true,
        starWidth: "18px",
        spacing: "3px",
        normalFill: "#ddd",
        ratedFill: "#16ccf5",
        readOnly: true,
    });    
});
$(document).on("click","#addcrt",function(){
    var e = $(".count span").html();
    var i=$("#product_id").val();
    var mainurl = $("#product_id").data("href");
    var prod_size_selector = (".product_size:checked");
    var s, o, r, a, l;

    if($('.product_size').is(":checked")){
        s = $(prod_size_selector).val(),
        o = $(prod_size_selector).closest('li').find(".size_qty").val();
        r = $(prod_size_selector).closest('li').find(".size_price").val();
        a = $(prod_size_selector).closest('li').find(".size_key").val();
    }else{
        s = '';
        o = '';
        r = '';
        a = '';
    }

    if($('input[name=color]').is(":checked")){
        l = $('input[name=color]').val();
    }else{
        l = '';
    }

   $(".product-attr").length>0 && (
       d=$(".product-attr:checked").map(function(){return $(this).val()}).get(),
       h=$(".product-attr:checked").map(function(){return $(this).data("key")}).get(),
       p=$(".product-attr:checked").map(function(){return $(this).data("price")}).get()),
            $.ajax({
                type:"GET",url:mainurl,data:{id:i,qty:e,size:s,color:l,size_qty:o,size_price:r,size_key:a,keys:h,values:d,prices:p},
                success:function(e){
                    "digital"==e?toastr.error(langg.already_cart):0==e?toastr.error(langg.out_stock):($("#cart-count").html(e[0]),$("#cart-items").load(mainurl+"/carts/view"),toastr.success('Added to cart successfully'))}})});


</script>
@endsection