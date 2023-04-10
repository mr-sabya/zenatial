@extends('layouts.main-ecommerce')

@section('content')
<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Blog</h2>
                    <nav class="breadcrumb">
                        <ul>
                            <li><a href="{{ route('front.index') }}">home</a></li>
                            <li><a class="disabled" href="{{ route('front.blog') }}">Blog</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner end -->
<!-- Blog start -->
<section class="blog-page pt-120 pb-120">
    <div class="container">
        <div class="row">
            @foreach($blogs as $blogg)
            <div class="col-lg-4 col-md-6 mb-30">
                <div class="blog-item white-bg shadow-light">
                    <div class="img">
                        <img class="img-fluid w-100" src="{{ $blogg->photo ? asset('assets/images/blogs/'.$blogg->photo):asset('assets/images/noimage.png') }}" alt="blog img">
                    </div>
                    <div class="text p-25">
                        <div class="title pb-20 flex left-center">
                            <img class="blogger-img" src="assets/images/avater.png" alt="blogger">
                            <span class="blogger-name ml-10">by Admin</span>
                            <span class="publish-date ml-auto"><i class="far fa-clock"></i> {{date('j M, Y', strtotime($blogg->created_at))}}</span>
                        </div>
                        <h4><a href="{{route('front.blogshow',$blogg->id)}}">{{mb_strlen($blogg->title,'utf-8') > 50 ? mb_substr($blogg->title,0,50,'utf-8')."...":$blogg->title}}</a></h4>
                        <a class="text-capitalize" href="{{route('front.blogshow',$blogg->id)}}">Read More ...</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Blog end -->
@endsection