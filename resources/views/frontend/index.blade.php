@extends('layouts.main-ecommerce')

@section('content')
    <!-- Banner start -->
    <section class="banner">
        <div class="banner-slide">
        @foreach($sliders as $data)
            <div class="banner-item pt-120 pb-120" style="background-image: url({{asset('assets/images/sliders/'.$data->photo)}});">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-10">
                            <span>{{$data->subtitle_text}}</span>
                            <h3>{{$data->title_text}}</h3>
                            <a class="btn mt-20" href="#">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </section>
    <!-- Banner end -->

    <!-- Category start -->
    <section class="collection pt-120 pb-120">
        <div class="container">
            <div class="row">
            @foreach($bottom_small_banners as $banner)
                <div class="mb-30 col-lg-4 col-md-6">
                    <div class="cat-item">
                        <img class="w-100 img-fluid" src="{{asset('assets/images/banners/'.$banner->photo)}}" alt="category">
                        <div class="cat-text">
                            <h3>{{ $banner->title }}</h3>
                            <p>{{ $banner->subtitle }}</p>
                            <a href="{{ $banner->link }}">{!! $banner->description !!}</a>
                        </div>
                        <!--<div class="overlay" style="background-image: url({{ asset('assets/front/img/category-overlay-1.jpg') }});"></div>-->
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>
    <!-- Category end -->

    <!-- Arrivals start -->
    <section class="arrivals pb-120">
        <div class="container">
            <div class="section-title">
                <h2 class="title-text">new arrivals</h2>
                <img src="{{ asset('assets/front/img/section-title.png') }}" alt="after title">
            </div>
            <div class="row">
            @foreach($latest_products as $prod)
                @include('includes.product.grid-product')
			@endforeach
            </div>
            <div class="section-btn text-center pt-40">
                <a href="{{ route('front.products', 'new-arrival') }}" class="btn white-btn">View all products</a>
            </div>
        </div>
    </section>
    <!-- Arrivals end -->

    <!-- summer-collection start -->
    <section class="summer-collection mb-120" style="background-image: url({{ asset('assets/front/img/summer-collect-bg.jpg') }});">
        <div class="container">
            <div class="row">
            @foreach($large_banners as $banner)
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="img">
                        <img src="{{asset('assets/images/banners/'.$banner->photo)}}" alt="{{ $banner->title }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="summer-text pt-120 pb-120">
                        <a href="#">{{ $banner->subtitle }}</a>
                        <h2>{{ $banner->title }}</h2>
                        <p>{{ $banner->description }}</p>
                        <a href="{{ $banner->link }}" class="btn">shop now</a>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>
    <!-- summer-collection end -->

    <!-- Best-sell start -->
    <section class="best-sell pb-120">
        <div class="container">
            <div class="section-title">
                <h2 class="title-text">Best Seller</h2>
                <img src="{{ asset('assets/front/img/section-title.png') }}" alt="after title">
            </div>
            <div class="flex center-center mb-50">
                <button class="filter-btn aa-control-active" type="button" data-filter=".trending">Trending</button>
                <button class="filter-btn" type="button" data-filter=".top-rated">top rated</button>
                <button class="filter-btn" type="button" data-filter=".best-sell">best offer</button>
            </div>
            <div class="row best-sell-filter">
            @foreach($best_products as $prod)
                @include('includes.product.grid-product')
			@endforeach
            </div>
            <div class="section-btn text-center pt-40">
                <a href="{{ route('front.products', 'new-arrival') }}" class="btn white-btn">View all products</a>
            </div>
        </div>
    </section>
    <!-- Best-sell end -->

    <!-- Count start -->
    @foreach($weekly_deal as $banner)
    <section class="count card-bg" style="background-image: url({{asset('assets/images/banners/'.$banner->photo)}});">
        <div class="container">
            <div class="row">
                <?php 
                $time = explode(",", $banner->description);
                ?>
                <div class="col-lg-5 offset-lg-1">
                    <div class="count-text text-center pt-100 pb-100">
                        <h2>{{ $banner->title }}</h2>
                        <p>{{ $banner->subtitle }}</p>
                        <div id="simply-countdown" data-year="{{ $time[0] }}" data-month="{{ $time[1] }}" data-data="{{ $time[2] }}" class="flex center-center mt-30 mb-30"></div>
                        <a href="#" class="btn">shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
    <!-- Count end -->

    <!-- Featured start -->
    <section class="featured pb-120 pt-120">
        <div class="container">
            <div class="section-title">
                <h2 class="title-text">FEATURED COLLECTION</h2>
                <img src="{{ asset('assets/front/img/section-title.png') }}" alt="after title">
            </div>
            <div class="row">
            @foreach($feature_products as $prod)
                @include('includes.product.grid-product')
			@endforeach
            </div>
            <div class="section-btn text-center pt-40">
                <a href="{{ route('front.products', 'featured-collection') }}" class="btn white-btn">View all products</a>
            </div>
        </div>
    </section>
    <!-- Featured end -->
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
    <!-- Related product start -->
    <section class="related-product pt-120 pb-120">
        <div class="container">
            <div class="section-title">
                <h2 class="title-text">related product</h2>
                <img src="{{ asset('assets/front/img/section-title.png') }}" alt="after title">
            </div>
            <div class="row">
            @foreach($feature_products as $prod)
                @include('includes.product.grid-product')
			@endforeach
            </div>
            <div class="section-btn text-center pt-40">
                <a href="{{ route('front.products', 'new-arrival') }}" class="btn white-btn">View all related products</a>
            </div>
        </div>
    </section>
    <!-- Related product end -->

    <!-- Client start -->
    <section class="client card-bg pt-80 pb-80">
        <div class="container">
            <div class="client-logos">
            @foreach($partners as $partner)
                <div class="text-center">
                    <a href="{{ $partner->link }}">
                        <img src="{{asset('assets/images/partner/'.$partner->photo)}}" alt="client logo">
                    </a>
                </div>
            @endforeach
            </div>
        </div>
    </section>
    <!-- Client end -->
    @include('includes.product.quickview')
@endsection

@section('scripts')
	<script>
        $(window).on('load',function() {

            setTimeout(function(){

                $('#extraData').load('{{route('front.extraIndex')}}');

            }, 500);
        });
    
    var mixer = mixitup('.best-sell-filter', {
        classNames: {
            block: 'aa'
        }
    });
        @foreach($weekly_deal as $banner)
        <?php 
        $time = explode(",", $banner->description);
        ?>    
        // Count down;
        $('#simply-countdown').simplyCountdown({
            year: {{ $time[0] }}, // required
            month: {{ $time[1] }}, // required
            day: {{ $time[2] }}, // required
            words: {
                days: 'day',
                hours: 'hours',
                minutes: 'mins',
                seconds: 'secs',
                pluralLetter: 's'
            },
        })   
        @endforeach 
	</script>
    @include('includes.product.quickviewjs')
@endsection