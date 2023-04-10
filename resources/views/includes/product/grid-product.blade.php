<div class="col-lg-3 col-md-6">
    <div class="card-item">
        <div class="img">
            <img src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt="arrival-item">
            <div class="overlay flex center-center">
                <div class="icons">																
                    <a href="javascript:" class="add-to-cart add-to-cart-btn" title="Buy Now" data-href="{{ route('product.cart.add',$prod->id) }}">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                    <a class="quick-view" rel-toggle="tooltip" title="Quick View" href="javascript:;" data-href="{{ route('product.quick',$prod->id) }}" data-toggle="modal" data-target="#quickview" data-placement="right"> 
                        <i class="fas fa-search-plus"></i>
                    </a>
                    @if(Auth::guard('web')->check())
                    <a href="javascript:;" class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="right" title="Add to Wishlist" data-placement="right">
                        <i class="far fa-heart"></i>
                    </a>
                    @else 
                    <a href="javascript:;" rel-toggle="tooltip" title="Add to Wishlist" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
                        <i class="far fa-heart"></i>
                    </a>
                    @endif                                    
                </div>
            </div>
        </div>
        <div class="text">
            <h6><a href="{{ route('front.product', $prod->slug) }}">{{ $prod->showName() }}</a></h6>
            <div class="price">{{ $prod->showPrice() }} <span class="discount">{{ $prod->showPreviousPrice() }}</span></div>
            <div class="rating flex">
                <div class="stars" data-rateyo-rating='{{App\Models\Rating::ratings($prod->id)}}'></div>
                <div class="stars-count">({{count($prod->ratings)}})</div>
            </div>
        </div>
    </div>
</div>              