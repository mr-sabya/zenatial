@extends('layouts.main-ecommerce')
@section('content')

<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Shop</h2>
                    <nav class="breadcrumb">
                        <ul>
                            <li><a href="{{ route('front.index') }}">home</a></li>
                            <li><a class="disabled" href="{{ route('front.category') }}">Shop</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner end -->

<!-- Shop-grid-right start -->
<main class="shop-grid-right pt-120 pb-120">
	<div class="container">
		<div class="row">
		@include('includes.catalog')

			<div class="card-content col-lg-9">
				<div class="row">
					<div class="col-lg-12 filter-area">
						<div class="filtering flex">
							<div class="view-btn">
								<a class="active mr-10 shadow-light" href="#"><i class="fas fa-th"></i></a>
								<a class="shadow-light" href="#"><i class="fas fa-list"></i></a>
							</div>
							<div class="filter-dropdown ml-auto">
								<div class="basic-form">
									<form class="flex">
										@include('includes.filter')
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="row" id="ajaxContent" style="width:100%;">
                		@include('includes.product.filtered-products')
            		</div>
				</div>
			</div>
		</div>
	</div>
</main>
<!-- Shop-grid-right end -->


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

  $(document).ready(function() {

    // when dynamic attribute changes
    $(".attribute-input, #sortby").on('change', function() {
      $("#ajaxLoader").show();
      filter();
    });

    // when price changed & clicked in search button
    $(".filter-btn").on('click', function(e) {
      e.preventDefault();
      $("#ajaxLoader").show();
      filter();
    });
  });

  function filter() {
    let filterlink = '';

    if ($("#prod_name").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?search='+$("#prod_name").val();
      } else {
        filterlink += '&search='+$("#prod_name").val();
      }
    }

    $(".attribute-input").each(function() {
      if ($(this).is(':checked')) {
        if (filterlink == '') {
          filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$(this).attr('name')+'='+$(this).val();
        } else {
          filterlink += '&'+$(this).attr('name')+'='+$(this).val();
        }
      }
    });

    if ($("#sortby").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#sortby").attr('name')+'='+$("#sortby").val();
      } else {
        filterlink += '&'+$("#sortby").attr('name')+'='+$("#sortby").val();
      }
    }

    if ($("#min_price").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#min_price").attr('name')+'='+$("#min_price").val();
      } else {
        filterlink += '&'+$("#min_price").attr('name')+'='+$("#min_price").val();
      }
    }

    if ($("#max_price").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#max_price").attr('name')+'='+$("#max_price").val();
      } else {
        filterlink += '&'+$("#max_price").attr('name')+'='+$("#max_price").val();
      }
    }

    // console.log(filterlink);
    console.log(encodeURI(filterlink));
    $("#ajaxContent").load(encodeURI(filterlink), function(data) {
      // add query string to pagination
      addToPagination();
      $("#ajaxLoader").fadeOut(1000);
    });
  }

  // append parameters to pagination links
  function addToPagination() {
    // add to attributes in pagination links
    $('ul.pagination li a').each(function() {
      let url = $(this).attr('href');
      let queryString = '?' + url.split('?')[1]; // "?page=1234...."

      let urlParams = new URLSearchParams(queryString);
      let page = urlParams.get('page'); // value of 'page' parameter

      let fullUrl = '{{route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')])}}?page='+page+'&search='+'{{request()->input('search')}}';

      $(".attribute-input").each(function() {
        if ($(this).is(':checked')) {
          fullUrl += '&'+encodeURI($(this).attr('name'))+'='+encodeURI($(this).val());
        }
      });

      if ($("#sortby").val() != '') {
        fullUrl += '&sort='+encodeURI($("#sortby").val());
      }

      if ($("#min_price").val() != '') {
        fullUrl += '&min='+encodeURI($("#min_price").val());
      }

      if ($("#max_price").val() != '') {
        fullUrl += '&max='+encodeURI($("#max_price").val());
      }

      $(this).attr('href', fullUrl);
    });
  }

  $(document).on('click', '.categori-item-area .pagination li a', function (event) {
    event.preventDefault();
    if ($(this).attr('href') != '#' && $(this).attr('href')) {
      $('#preloader').show();
      $('#ajaxContent').load($(this).attr('href'), function (response, status, xhr) {
        if (status == "success") {
          $('#preloader').fadeOut();
          $("html,body").animate({
            scrollTop: 0
          }, 1);

          addToPagination();
        }
      });
    }
  });

</script>
@endsection