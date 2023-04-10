<div class="details-content" id="product-preview">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="img-gallery h-100">
                            <img class="w-100 img-fluid view-area" id="product-img" src="{{filter_var($product->photo, FILTER_VALIDATE_URL) ?$product->photo:asset('assets/images/products/'.$product->photo)}}" data-zoom-image="{{filter_var($product->photo, FILTER_VALIDATE_URL) ?$product->photo:asset('assets/images/products/'.$product->photo)}}" alt="product img">
                            <div id="img-gallery" class="flex">
                                <a class="active" href="#" data-image="{{filter_var($product->photo, FILTER_VALIDATE_URL) ?$product->photo:asset('assets/images/products/'.$product->photo)}}" data-zoom-image="{{filter_var($product->photo, FILTER_VALIDATE_URL) ?$product->photo:asset('assets/images/products/'.$product->photo)}}">
                                    <img class="product-img" src="{{filter_var($product->photo, FILTER_VALIDATE_URL) ?$product->photo:asset('assets/images/products/'.$product->photo)}}" alt="product img">
                                </a>
                              @foreach($product->galleries as $gal)
                                <a href="#" data-image="{{asset('assets/images/galleries/'.$gal->photo)}}" data-zoom-image="{{asset('assets/images/galleries/'.$gal->photo)}}">
                                    <img class="product-img" src="{{asset('assets/images/galleries/'.$gal->photo)}}" alt="product img">
                                </a>
                              @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-content">
                            <h4>{{ $product->name }}</h4>
                            <div class="price-rating flex left-bottom">
                                <div class="pricing">
                                    <span class="price">{{ $product->showPrice() }}</span>
                                    <span class="discount ml-20">{{ $product->showPreviousPrice() }}</span>
                                    <?php 
                                    //$difference = ($product->showPreviousPrice() - $product->showPrice());
                                    //$discount = ($difference * 100) / $product->showPreviousPrice();
                                    ?>
                                </div>
                                <div class="rating flex ml-auto">
                                    <div class="stars"></div>
                                    <div class="stars-count">({{count($product->ratings)}})</div>
                                </div>
                            </div>
                            <p class="product-details mt-30">{!! $product->details !!}</p>
                            <ul style="display:none;" class="color flex left-center mt-30">
                                <li class="mr-10">Color: </li>
                                                                                                <li>
                                    <input type="radio" class="product_color" checked name="color" value="#000000" >
                                    <label for="#000000" style="background-color:#000000"></label>
                                </li> 
                                                                                                <li>
                                    <input type="radio" class="product_color"  name="color" value="#15a0bf" >
                                    <label for="#15a0bf" style="background-color:#15a0bf"></label>
                                </li> 
                                                                                                <li>
                                    <input type="radio" class="product_color"  name="color" value="#f5cf07" >
                                    <label for="#f5cf07" style="background-color:#f5cf07"></label>
                                </li> 
                                                                                                <li>
                                    <input type="radio" class="product_color"  name="color" value="#2b4cc2" >
                                    <label for="#2b4cc2" style="background-color:#2b4cc2"></label>
                                </li> 
                                                                                                <li>
                                    <input type="radio" class="product_color"  name="color" value="#247d32" >
                                    <label for="#247d32" style="background-color:#247d32"></label>
                                </li> 
                                                                                                <li>
                                    <input type="radio" class="product_color"  name="color" value="#d62727" >
                                    <label for="#d62727" style="background-color:#d62727"></label>
                                </li> 
                                                                                                                               
                            </ul>   
                            <ul style="display:none;" class="size flex left-center mt-30">
                                <li class="mr-10">Size</li>
                                                                                                
                                <li>
                                    <input class="product_size" type="radio" name="product_size" checked value="S">
                                    <label for="S">S</label>
                                    <input type="hidden" class="size" value="S">
                                    <input type="hidden" class="size_qty" value="2147483595">
                                    <input type="hidden" class="size_key" value="0">
                                    <input type="hidden" class="size_price" value="0">                                    
                                </li>
                                                                                                
                                <li>
                                    <input class="product_size" type="radio" name="product_size"  value="M">
                                    <label for="M">M</label>
                                    <input type="hidden" class="size" value="M">
                                    <input type="hidden" class="size_qty" value="2147483597">
                                    <input type="hidden" class="size_key" value="1">
                                    <input type="hidden" class="size_price" value="0">                                    
                                </li>
                                                                                                
                                <li>
                                    <input class="product_size" type="radio" name="product_size"  value="L">
                                    <label for="L">L</label>
                                    <input type="hidden" class="size" value="L">
                                    <input type="hidden" class="size_qty" value="2147483597">
                                    <input type="hidden" class="size_key" value="2">
                                    <input type="hidden" class="size_price" value="0">                                    
                                </li>
                                                                                            </ul>                          
                                                        <ul> 
                                <ul style="display:none;">
                                    <div class="product-attributes my-4">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-2">
                                                    <strong for="" class="text-capitalize">warranty type :</strong>
                                                    <div class="">
                                                        <div class="custom-control custom-radio">
                                                            <input type="hidden" class="keys" value="">
                                                            <input type="hidden" class="values" value="">
                                                            <input type="radio" id="warranty_type0" name="warranty_type" class="custom-control-input product-attr" data-key="warranty_type" data-price="0" value="Local seller warranty" checked="">
                                                            <label class="custom-control-label" for="warranty_type0">Local seller warranty
                                                            +
                                                            $ 78
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="hidden" class="keys" value="">
                                                            <input type="hidden" class="values" value="">
                                                            <input type="radio" id="warranty_type1" name="warranty_type" class="custom-control-input product-attr" data-key="warranty_type" data-price="0" value="international manufacturer warranty">
                                                            <label class="custom-control-label" for="warranty_type1">international manufacturer warranty
                                                            +
                                                            $ 45
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-2">
                                                    <strong for="" class="text-capitalize">brand :</strong>
                                                    <div class="">
                                                        <div class="custom-control custom-radio">
                                                            <input type="hidden" class="keys" value="">
                                                            <input type="hidden" class="values" value="">
                                                            <input type="radio" id="brand0" name="brand" class="custom-control-input product-attr" data-key="brand" data-price="0" value="Symphony" checked="">
                                                            <label class="custom-control-label" for="brand0">Symphony
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="hidden" class="keys" value="">
                                                            <input type="hidden" class="values" value="">
                                                            <input type="radio" id="brand1" name="brand" class="custom-control-input product-attr" data-key="brand" data-price="0" value="Apple">
                                                            <label class="custom-control-label" for="brand1">Apple
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-2">
                                                    <strong for="" class="text-capitalize">ram :</strong>
                                                    <div class="">
                                                        <div class="custom-control custom-radio">
                                                            <input type="hidden" class="keys" value="">
                                                            <input type="hidden" class="values" value="">
                                                            <input type="radio" id="ram0" name="ram" class="custom-control-input product-attr" data-key="ram" data-price="0" value="1 GB" checked="">
                                                            <label class="custom-control-label" for="ram0">1 GB
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="hidden" class="keys" value="">
                                                            <input type="hidden" class="values" value="">
                                                            <input type="radio" id="ram1" name="ram" class="custom-control-input product-attr" data-key="ram" data-price="0" value="3 GB">
                                                            <label class="custom-control-label" for="ram1">3 GB
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-2">
                                                    <strong for="" class="text-capitalize">color family :</strong>
                                                    <div class="">
                                                        <div class="custom-control custom-radio">
                                                            <input type="hidden" class="keys" value="">
                                                            <input type="hidden" class="values" value="">
                                                            <input type="radio" id="color_family0" name="color_family" class="custom-control-input product-attr" data-key="color_family" data-price="0" value="Sliver" checked="">
                                                            <label class="custom-control-label" for="color_family0">Sliver
                                                            +
                                                            $ 67
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="hidden" class="keys" value="">
                                                            <input type="hidden" class="values" value="">
                                                            <input type="radio" id="color_family1" name="color_family" class="custom-control-input product-attr" data-key="color_family" data-price="0" value="Brown">
                                                            <label class="custom-control-label" for="color_family1">Brown
                                                            +
                                                            $ 5
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </ul>                                                                                                            
                            @if(!empty($product->color))
                            <ul class="color flex left-center mt-30">
                                <li class="mr-10">Color: </li>
                                <?php 
                                $i = 0;
                                ?>
                                @foreach($product->color as $key => $data1)
                                <li>
                                    <input type="radio" class="product_color" <?php echo $i == 0 ? 'checked' : '';  ?> name="color" value="{{ $product->color[$key] }}" >
                                    <label for="{{ $product->color[$key] }}" style="background-color:{{ $product->color[$key] }}"></label>
                                </li> 
                                <?php 
                                $i++;
                                ?>
                                @endforeach                                                               
                            </ul>
                            @endif
                            @if(!empty($product->size))
                            <ul class="size flex left-center mt-30">
                                <li class="mr-10">Size</li>
                                <?php 
                                $i = 0;
                                ?>
                                @foreach($product->size as $key => $data1)                                
                                <li>
                                    <input class="product_size" type="radio" name="product_size" <?php echo $i == 0 ? 'checked' : '';  ?> value="{{ $data1 }}">
                                    <label for="{{$data1}}">{{$data1}}</label>
                                    <input type="hidden" class="size" value="{{ $data1 }}">
                                    <input type="hidden" class="size_qty" value="{{ $product->size_qty[$key] }}">
                                    <input type="hidden" class="size_key" value="{{$key}}">
                                    <input type="hidden" class="size_price" value="{{ round($product->size_price[$key] * $curr->value,2) }}">                                    
                                </li>
                                <?php 
                                $i++;
                                ?>
                                @endforeach
                            </ul>                          
                            @endif
                            <ul>
                            @if (!empty($product->attributes))
                            @php
                            $attrArr = json_decode($product->attributes, true);
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
                                if($product->childcategory_id != null){
                                ?>
                                <li><span>Category:</span> <?php $result = App\Models\Childcategory::where('id','=',$product->childcategory_id)->get(); echo $result[0]->name; ?></li>
                                <?php 
                                }elseif($product->subcategory_id != null){
                                ?>
                                <li><span>Category:</span> <?php $result = App\Models\Subcategory::where('id','=',$product->subcategory_id)->get(); echo $result[0]->name; ?></li>
                                <?php 
                                }elseif($product->category_id != null){
                                ?>
                                <li><span>Category:</span> <?php $result = App\Models\Category::where('id','=',$product->category_id)->get(); echo $result[0]->name; ?></li>
                                <?php 
                                }
                                ?>
                                <li><span>SKU:</span> {{  $product->sku }}</li>
                            </ul>
                            <div class="item-count flex left-center mt-30">
                                @if($product->emptyStock())
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
                            <input type="hidden" id="product_price" value="{{ round($product->vendorPrice() * $curr->value,2) }}">
                            <input type="hidden" id="product_id" data-href="{{ route('product.addnumcart') }}" value="{{ $product->id }}">
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
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">{!! $product->details !!}</div>
                    <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">{!! $product->policy !!}</div>
                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                        <p>Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Vivamus bibendum magna Lorem ipsum dolor sit amet, consectetur adipiscing elit.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
                        <p>Lorem Ipsum et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident,</p>
                        <p>Lorem Ipsum et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                    </div>
                  </div>
            </div>



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
        rating: {{count($product->ratings)}},
        halfStar: true,
        starWidth: "18px",
        spacing: "3px",
        normalFill: "#ddd",
        ratedFill: "#16ccf5",
        readOnly: true,
    });    
});
$(document).on("click","#addcrt",function(){
    var e = $("#quickview .count span").html(),
    i=$("#quickview #product_id").val(),
    mainurl = $("#quickview #product_id").data("href"),
    prod_size_selector = ("#quickview .product_size:checked"),
    s = $(prod_size_selector).val(),
    o = $(prod_size_selector).closest('li').find(".size_qty").val(),
    r = $(prod_size_selector).closest('li').find(".size_price").val(),
    a = $(prod_size_selector).closest('li').find(".size_key").val(),
    l = $('input[name=color]').val();

   $(".product-attr").length>0 && (
       d=$("#quickview .product-attr:checked").map(function(){return $(this).val()}).get(),
       h=$("#quickview .product-attr:checked").map(function(){return $(this).data("key")}).get(),
       p=$("#quickview .product-attr:checked").map(function(){return $(this).data("price")}).get()),
            $.ajax({
                type:"GET",url:mainurl,data:{id:i,qty:e,size:s,color:l,size_qty:o,size_price:r,size_key:a,keys:h,values:d,prices:p},
                success:function(e){
                    "digital"==e?toastr.error(langg.already_cart):0==e?toastr.error(langg.out_stock):($("#cart-count").html(e[0]),$("#cart-items").load(mainurl+"/carts/view"),toastr.success('Added to cart successfully'))}})});


</script>
           