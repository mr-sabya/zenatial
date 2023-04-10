@extends('layouts.main-ecommerce')

@section('content')
<!-- Banner start -->
<section class="page-banner pt-150 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>FAQ</h2>
                    <nav class="breadcrumb">
                        <ul>
                            <li><a href="{{ route('front.index') }}">home</a></li>
                            <li><a class="disabled" href="{{ route('front.faq') }}">FAQ</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner end -->
    <!-- FAQ start -->
    <section class="faq-page pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="faq-tabs shadow-light">
                        <div class="nav flex-column nav-pills mb-30" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <?php 
                            $i = 0;
                            ?>
                            @foreach($fcats as $cats)
                            <a class="nav-link <?php echo $i ==0 ? 'active' : ''; ?>" data-toggle="pill" href="#{{ $cats->getSlug() }}" role="tab">{{ $cats->name }}</a>
                            <?php 
                            $i++;
                            ?>                            
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content">
                        <?php 
                        $i = 0;
                        ?>
                        @foreach($fcats as $cats)
                        <div class="tab-pane fade <?php echo $i ==0 ? 'active show' : ''; ?>" id="{{ $cats->getSlug() }}" role="tabpanel">
                            @foreach($cats->faqs as $faq)
                            <h4 class="mb-30">{{ $cats->name }}</h4>
                            <div class="question shadow-light mb-30">
                                <a class="" data-toggle="collapse" href="#ques-10" role="button"><i
                                        class="fas fa-chevron-down"></i> {{ $faq->title }} </a>
                                <div class="collapse show" id="ques-10">
                                    <div class="card card-body">
                                        <p>{!! $faq->details !!}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <?php 
                        $i++;
                        ?>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ end -->
@endsection