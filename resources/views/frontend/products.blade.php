@extends('layouts.main-ecommerce')
@section('content')

<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>{{ $type }}</h2>
                    <nav class="breadcrumb">
                        <ul>
                            <li><a href="{{ route('front.index') }}">home</a></li>
                            <li><a class="disabled" href="{{ route('front.category') }}">Shop</a></li>
                            <li><a class="disabled" href="javascript:;">{{ $type }}</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner end -->

<!-- Shop-regular start -->
<main class="shop-regular pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="row" id="ajaxContent">
                @foreach($products as $prod)
                    @include('includes.product.grid-product')
                @endforeach
            </div>
            <div class="col-lg-12">
                <div class="flex center-center w-100 pt-40">
                    {!! $products->appends(['search' => request()->input('search')])->links() !!}
                </div>
            </div>            
        </div>
    </div>
</main>
<!-- Shop-regular end -->

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

@include('includes.product.quickview')

@endsection 

@section('scripts')
@include('includes.product.quickviewjs')
<script>
  $(document).on("change", "#d-shorting", function(){
    var val = $(this).val();
    var to = '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?sort='+val;
    $.ajax({
      url: to,
      type: "GET",
      dataType: "text",
      success: function(r){
        $("#ajaxContent").html(r);
      }
    });    
  }); 
</script>
@endsection