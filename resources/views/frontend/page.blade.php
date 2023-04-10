@extends('layouts.main-ecommerce')

@section('content')
<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>{{ $page->title }}</h2>
                    <nav class="breadcrumb">
                        <ul>
                            <li><a href="{{ route('front.index') }}">home</a></li>
                            <li><a class="disabled" href="{{ route('front.page',$page->slug) }}">{{ $page->title }}</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner end -->
<!-- Contact start -->
<section class="contact-page">
    <div class="page-content">
        <div class="container">
            <div class="row">

                    <div class="shadow-light">
                        <div class="card-body">
                        {!! $page->details !!}
                        </div>
                    </div>          
            </div>
        </div>
    </div>
</section>
<!-- Contact end -->
@endsection