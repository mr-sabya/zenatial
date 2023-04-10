<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="{{ $page->meta_description }}">
		<title>{{ App\Models\Generalsetting::find(1)->site_name }} | {{ App\Models\Generalsetting::find(1)->title }} </title>
    @elseif(isset($blog->meta_tag) && isset($blog->meta_description))
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="{{ $blog->meta_description }}">
		<title>{{ App\Models\Generalsetting::find(1)->site_name }} | {{ App\Models\Generalsetting::find(1)->title }} </title>
    @elseif(isset($productt))
		<meta name="keywords" content="{{ !empty($productt->meta_tag) ? implode(',', $productt->meta_tag ): '' }}">
		<meta name="description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}">
	    <meta name="author" content="Shoaib Ibn Abdullah">
    	<title>{{substr($productt->name, 0,11)." | "}}{{ App\Models\Generalsetting::find(1)->title }}</title>
    @else
	    <meta name="keywords" content="{{ $gs->meta_keys }}">
        <meta name="description" content="{{ $gs->meta_desc }}">
	    <meta name="author" content="Shoaib Ibn Abdullah">
		<title>{{ App\Models\Generalsetting::find(1)->site_name }} | {{ App\Models\Generalsetting::find(1)->title }} </title>
    @endif    

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/front/img/favicon.ico') }}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/webfonts/font-awesome/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/webfonts/iconfont/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/webfonts/flaticon/flaticon.css') }}">    
    <link rel="stylesheet" href="{{ asset('assets/front/css/jquery.rateyo.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/pagination.css') }}">
</head>

<body class="theme-bg">
    <!-- Search start -->
    <div class="search" id="search">
        <i id="search-close" class="icofont-close-line"></i>
        <form>
            <input type="search" name="search" id="prod_name" placeholder="search" autocomplete="off">
            <button type="submit"><i class="icofont-search-1"></i></button>
        </form>
    </div>
    <!-- Search end -->
    
    <!-- Header start -->
    <header class="header white-bg">
        <div class="top-header pt-10 pb-10 border-bottom">
            <div class="container flex left-center">
                <span class="mr-15">                            
                    @if(App\Models\Generalsetting::find(1)->welcome_text != '')
                        {{ App\Models\Generalsetting::find(1)->welcome_text }}        
                    @endif
                </span>
                <span>  
                @if(App\Models\Generalsetting::find(1)->call_us_no != '')
                    <i class="fas fa-phone-alt mr-5"></i>
                    Call us: {{ App\Models\Generalsetting::find(1)->call_us_no }}
                @endif
                </span>
                <span class="m-auto">
                @if(App\Models\Generalsetting::find(1)->free_shipping_over != '')
                    <span class="text-uppercase text-theme">FREE SHIPPING</span> - on all orders over ৳ {{ App\Models\Generalsetting::find(1)->free_shipping_over }}</span>
                @endif
                    
                <ul class="header-social flex">
                    @if(App\Models\Generalsetting::find(1)->facebook != '')
                        <li><a href="{{ App\Models\Generalsetting::find(1)->facebook }}"><i class="fab fa-facebook"></i></a></li>
                    @endif                            
                    @if(App\Models\Generalsetting::find(1)->twitter != '')
                        <li><a href="{{ App\Models\Generalsetting::find(1)->twitter }}"><i class="fab fa-twitter"></i></a></li>
                    @endif                            
                    @if(App\Models\Generalsetting::find(1)->instagram != '')
                        <li><a href="{{ App\Models\Generalsetting::find(1)->instagram }}"><i class="fab fa-instagram"></i></a></li>
                    @endif                            
                    @if(App\Models\Generalsetting::find(1)->youtube != '')
                        <li><a href="{{ App\Models\Generalsetting::find(1)->youtube }}"><i class="fab fa-youtube"></i></a></li>
                    @endif                            
                    @if(App\Models\Generalsetting::find(1)->linkedin != '')
                        <li><a href="{{ App\Models\Generalsetting::find(1)->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                    @endif
                </ul>               
            </div>
        </div>
        <div class="bottom-header pb-15 pt-15">
            <div class="container flex left-center position-relative">
                <div class="brand-logo">
                    <a href="{{ route('front.index') }}">
                        <img src="{{asset('assets/images/'.App\Models\Generalsetting::find(1)->logo)}}" alt="brand logo">
                    </a>
                </div>
                <nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg ml-auto">
                    <div class="offcanvas-header p-15">
                        <!-- <button class="btn btn-close float-right">Close</button> -->
                        <i class="icofont-close btn-close float-right"></i>
                        <a href="{{ route('front.index') }}">
                            <img src="{{asset('assets/images/'.App\Models\Generalsetting::find(1)->logo)}}" alt="brand logo">
                        </a>
                    </div>
                    <?php $cat_on_nav = App\Models\Category::where('show_on_mainnav','=',1)->get(); ?>
                    <ul class="navbar-nav">
                        <li class="nav-item active"> <a class="nav-link" href="{{ route('front.index') }}">Home </a> </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('front.products', 'new-arrival') }}">New arrivals</a></li>
                        <?php
                        $i = 0;
                        ?>
                        @foreach($cat_on_nav as $cats_on_nav)
                            <li class="nav-item"><a class="nav-link" href="{{route('front.category', $cats_on_nav->slug)}}">{{$cats_on_nav->name}}</a></li>
                            <?php
                            if($i == 2){
                                break;
                            }else{
                                $i++; 
                            }
                            ?>          
                        @endforeach
                        <?php 
                        $first_subcat_on_nav = App\Models\Subcategory::where('category_id','=',$cat_on_nav[0]->id)->get(); 
                        $second_subcat_on_nav = App\Models\Subcategory::where('category_id','=',$cat_on_nav[1]->id)->get(); 
                        $third_subcat_on_nav = App\Models\Subcategory::where('category_id','=',$cat_on_nav[2]->id)->get();
                        $fourth_subcat_on_nav = App\Models\Subcategory::where('category_id','=',$cat_on_nav[3]->id)->get();
                        ?>
                        <li class="nav-item dropdown has-megamenu">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Best seller</a>
                            <div class="dropdown-menu megamenu" role="menu">
                                <div class="row">
                                    <div class="col-lg-3 p-0 border-right">
                                        <div class="col-megamenu">
                                            <h6 class="title">{{$cat_on_nav[0]->name}}</h6>
                                            <ul class="list-unstyled">
                                            @foreach($first_subcat_on_nav as $val)
                                                <li class="nav-item"><a class="nav-link" href="{{route('front.category', ['category'=>$cat_on_nav[0]->slug, 'subcategory'=>$val->slug])}}">{{$val->name}}</a></li>
                                            @endforeach
                                            </ul>
                                        </div> 
                                    </div>
                                    <div class="col-lg-3 p-0 border-right">
                                        <div class="col-megamenu">
                                            <h6 class="title">{{$cat_on_nav[1]->name}}</h6>
                                            <ul class="list-unstyled">
                                            @foreach($second_subcat_on_nav as $val)
                                                <li class="nav-item"><a class="nav-link" href="{{route('front.category', ['category'=>$cat_on_nav[0]->slug, 'subcategory'=>$val->slug])}}">{{$val->name}}</a></li>
                                            @endforeach
                                            </ul>
                                        </div> 
                                    </div>
                                    <div class="col-lg-3 p-0 border-right">
                                        <div class="col-megamenu">
                                            <h6 class="title">{{$cat_on_nav[2]->name}}</h6>
                                            <ul class="list-unstyled">
                                            @foreach($third_subcat_on_nav as $val)
                                                <li class="nav-item"><a class="nav-link" href="{{route('front.category', ['category'=>$cat_on_nav[0]->slug, 'subcategory'=>$val->slug])}}">{{$val->name}}</a></li>
                                            @endforeach
                                            </ul>
                                        </div> 
                                    </div>
                                    <div class="col-lg-3 p-0">
                                        <div class="col-megamenu border-0">
                                            <h6 class="title">{{$cat_on_nav[3]->name}}</h6>
                                            <ul class="list-unstyled">
                                            @foreach($fourth_subcat_on_nav as $val)
                                                <li class="nav-item"><a class="nav-link" href="{{route('front.category', ['category'=>$cat_on_nav[0]->slug, 'subcategory'=>$val->slug])}}">{{$val->name}}</a></li>
                                            @endforeach
                                            </ul>
                                        </div> 
                                    </div>
                                    <div class="col-lg-12 megamenu-footer mt-15">
                                        <div class="row">
                                        @foreach($navbanners as $navbanner)
                                            <div class="col-lg-4 col-md-6 mb-30 mb-lg-0">
                                                <div class="content">
                                                    <img class="img-fluid w-100" src="{{asset('assets/images/banners/'.$navbanner->photo)}}" alt="card">
                                                    <div class="text">
                                                        <span class="text-capitalize">{{ $navbanner->subtitle }}</span>
                                                        <h4 class="text-capitalize">{{ $navbanner->title }}</h4>
                                                        <a href="{{ $navbanner->link }}">{{ $navbanner->description }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown">Pages</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="dropdown-item nav-link" href="{{ route('front.contact') }}">contact us</a></li>
                                <li class="nav-item"><a class="dropdown-item nav-link" href="{{ route('front.faq') }}">FAQ</a></li>
                                <li class="nav-item"><a class="dropdown-item nav-link" href="{{ route('user.login') }}">log in</a></li>
                                <li class="nav-item"><a class="dropdown-item nav-link" href="{{ route('user-register') }}">register</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <ul class="flex right-center icons">
                    <li><a href="#" id="search-btn"><i class="icofont-search"></i></a></li>
                    <li><a href="{{route('front.cart')}}"><i class="icofont-shopping-cart"></i><span id="cart-count" class="badge bg-primary text-white" style="position:relative; top:-9px; right:6px; font-weight:normal; font-size:8px; width:12px; height: 12px;">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span></a></li>
                    <li><a href="{{route('user.login')}}"><i class="icofont-user"></i></a></li>
                    <li><a class="d-block d-lg-none" data-trigger="#navbar_main" href="#"><i class="icofont-navigation-menu"></i></a></li>
                </ul>
            </div>
        </div>
    </header>
    <!-- Header end -->

    @yield('content')

    <!-- Footer start -->
    <footer class="footer pt-120">
        <div class="container pb-120">
            <div class="row">
                <div class="mb-30 col-lg-3 col-md-6 col-sm-12">
                    <div class="footer-logo">
                        <a href="#">
                            <img src="{{asset('assets/images/'.App\Models\Generalsetting::find(1)->footer_logo)}}" alt="logo">
                        </a>
                        @if(App\Models\Generalsetting::find(1)->footer != '')
                        <p class="pt-30">{!! App\Models\Generalsetting::find(1)->footer !!}</p>
                        @endif

                        @if(App\Models\Generalsetting::find(1)->appstore != '' || App\Models\Generalsetting::find(1)->playstore != '')
                            <h5 class="text-capitalize pb-20">Download App</h5>
                        @endif
                        @if(App\Models\Generalsetting::find(1)->appstore != '')
                            <a class="shadow mr-20" href="{{ App\Models\Generalsetting::find(1)->appstore }}"><img src="{{ asset('assets/front/img/app-store-btn.png') }}" alt="download btn"></a>
                        @endif
                        @if(App\Models\Generalsetting::find(1)->playstore != '')
                            <a class="shadow" href="{{ App\Models\Generalsetting::find(1)->playstore }}"><img src="{{ asset('assets/front/img/google-play-btn.png') }}" alt="download btn"></a>
                        @endif
                    </div>
                </div>
                <div class="mb-30 col-lg-2 col-md-3 col-sm-6">
                    <div class="quick-link">
                        <h4 class="pb-30">Quick links</h4>
                        <ul>
                            @foreach(DB::table('pages')->where('footer','=',1)->get() as $data)
							<li>
								<a href="{{ route('front.page',$data->slug) }}">
									{{ $data->title }}
								</a>
							</li>
							@endforeach
							<li>
								<a href="{{ route('front.faq') }}">
									FAQ
								</a>
							</li>                            
							<li>
								<a href="{{ route('front.contact') }}">
									Contact Us
								</a>
							</li>                            
                        </ul>
                    </div>
                </div>
                <div class="mb-30 col-lg-2 col-md-3 col-sm-6">
                    <div class="footer-category">
                        <h4 class="pb-30">category</h4>
                        <ul>
                        @foreach($categories as $cat)
                            @if($cat->show_on_footer == 1)
                                <li><a href="{{ route('front.category', $cat->slug) }}">{{ $cat->name }}</a></li>
                            @endif
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="mb-30 col-lg-2 col-md-6 col-sm-6">
                    <div class="business">
                        <h4 class="pb-30">Business</h4>
                        <ul>
                            <li><a href="#">Be a vendor</a></li>
                            <li><a href="#">Buy wholesale</a></li>
                            <li><a href="#">Offer</a></li>
                            <li><a href="#">Best value</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mb-30 col-lg-3 col-md-6 col-sm-6">
                    <div class="contact">
                        <h4 class="pb-30">Contact</h4>
                        <ul>
                            <li><i class="fas fa-home"></i>{{ App\Models\Generalsetting::find(1)->address }}</li>
                            <li><i class="far fa-envelope"></i><a href="mailto:{{ App\Models\Generalsetting::find(1)->official_email }}">{{ App\Models\Generalsetting::find(1)->official_email }}</a></li>
                            <li><i class="fas fa-phone-alt"></i>{{ App\Models\Generalsetting::find(1)->official_no }}</li>
                        </ul>
                        <div class="footer-social pt-20">
                            <ul class="flex left-center">
                                @if(App\Models\Generalsetting::find(1)->facebook != '')
                                    <li><a href="{{ App\Models\Generalsetting::find(1)->facebook }}"><i class="fab fa-facebook"></i></a></li>
                                @endif                            
                                @if(App\Models\Generalsetting::find(1)->twitter != '')
                                    <li><a href="{{ App\Models\Generalsetting::find(1)->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                @endif                            
                                @if(App\Models\Generalsetting::find(1)->instagram != '')
                                    <li><a href="{{ App\Models\Generalsetting::find(1)->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                @endif                            
                                @if(App\Models\Generalsetting::find(1)->youtube != '')
                                    <li><a href="{{ App\Models\Generalsetting::find(1)->youtube }}"><i class="fab fa-youtube"></i></a></li>
                                @endif                            
                                @if(App\Models\Generalsetting::find(1)->linkedin != '')
                                    <li><a href="{{ App\Models\Generalsetting::find(1)->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                                @endif                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright card-bg pt-30 pb-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 order-2 order-lg-1">
                        <div class="copyright-text h-100 flex left-center">
                            <p class="mb-0 pt-10 pb-10 ">{!! App\Models\Generalsetting::find(1)->copyright !!}</p>
                        </div>
                    </div>
                    <div class="col-lg-5 order-1 order-lg-2">
                        <div class="copyright-card text-center text-lg-right text-xl-right">
                            <h5>Easy and Secure Payment System</h5>
                            <img src="{{ asset('assets/front/img/card-ame.png') }}" alt="payment card">
                            <img src="{{ asset('assets/front/img/card-master.png') }}" alt="payment card">
                            <img src="{{ asset('assets/front/img/card-nogod.png') }}" alt="payment card">
                            <img src="{{ asset('assets/front/img/card-pay.png') }}" alt="payment card">
                            <img src="{{ asset('assets/front/img/card-vissa.png') }}" alt="payment card">
                            <img src="{{ asset('assets/front/img/card-nogod.png') }}" alt="payment card">
                            <img src="{{ asset('assets/front/img/card-bkash.png') }}" alt="payment card">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer end -->
    
    <!-- JS here -->
    <script src="{{ asset('assets/front/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.rateyo.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/simplyCountdown.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery-asRange.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{asset('assets/front/js/toastr.js')}}"></script>
    <script src="{{ asset('assets/front/js/custom.js') }}"></script>
    {!! $gs->google_analytics !!}
    @yield('scripts')
</body>

</html>