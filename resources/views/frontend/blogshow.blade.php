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
                            <li><a class="disabled" href="javascript:;">{{ $blog->title }}</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner end -->
<!-- Single-blog start -->
<section class="single-blog pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="main-content">
                    <img class="mt-0" src="{{ asset('assets/images/blogs/'.$blog->photo) }}" alt="single blog img">
                    <div class="title pt-20 pb-20">
                        <img class="blogger-avatar" src="assets/images/avater.png" alt="blogger">
                        <span class="blogger-name mr-30">by Admin</span>
                        <span class="publish-date mr-30"><i class="far fa-clock"></i> {{date('j M, Y', strtotime($blog->created_at))}}</span>
                        <span class="comment-count mr-30"><i class="far fa-comments"></i> 07 comments</span>
                        <span class="like-count"><i class="far fa-eye"></i> {{ $blog->views }}</span>
                    </div>
                    <h4>{{ $blog->title }}</h4>
                    {!! $blog->details !!}

                    <div class="tags-content flex left-center mt-50 pt-30 pb-30 border-top border-bottom">
                        <div class="tags-2">
                            <i class="fas fa-tag"></i>
                            @foreach(explode(',', $blog->tags) as $key => $tag)
                            <a href="{{ route('front.blogtags',$tag) }}">
                            {{ $tag }}{{ $key != count(explode(',', $blog->tags)) - 1  ? ',':''}}
                            </a>
                            @endforeach
                        </div>
                        <div class="share ml-auto">
                            <a class="a2a_dd plus" href="https://www.addtoany.com/share"><i class="fas fa-share-alt"></i> Share this article</a>
                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                        </div>
                    </div>
                    <div class="blogger-content flex left-center border-bottom pt-15 pb-15">
                        <div class="blogger-img">
                            <img src="assets/img/avater.png" alt="avater">
                        </div>
                        <div class="blogger-text pl-20">
                            <h4>John Doe</h4>
                            <p>Ut enim ad minima veniam, quis nostrum exerci tationem ullam corporis suscipit den ser mori ten lorem domrem.
                                laboriosam, nisi ut aliquid ex ea commodi consequatur.</p>
                            <ul class="blogger-social flex">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="side-content">
                    <div class="search-oneline basic-form">
                        <form action="{{ route('front.blogsearch') }}">
                            <input class="form-control" type="search" name="search" placeholder="Search here">
                            <button class="search-submit" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div>
                        <h6 class="text-capitalize pb-10 mb-30 mt-50">CATEGORIES</h6>
                        <ul class="category-2">
                        @foreach($bcats as $cat)
                            <li {!! $cat->id == $blog->category_id ? 'class="active"':'' !!}><a href="{{ route('front.blogcategory', $cat->slug) }}">{{ $cat->name }} <span>{{ $cat->blogs()->count() }}</span></a></li>
                        @endforeach
                        </ul>
                    </div>
                    <div class="recent-post">
                        <h6 class="text-capitalize mb-30 pb-10 mt-50">recent post</h6>
                        <ul>
                        @foreach (App\Models\Blog::orderBy('created_at', 'desc')->limit(4)->get() as $blog)
                            <li class="mb-30">
                                <a class="flex left-center" href="{{ route('front.blogshow',$blog->id) }}">
                                    <div class="img shadow-light">
                                        <img class="img-fluid w-100" src="{{ asset('assets/images/blogs/'.$blog->photo) }}" alt="blog details">
                                    </div>
                                    <div class="text pl-10">
                                        <p class="mb-0">{{mb_strlen($blog->title,'utf-8') > 45 ? mb_substr($blog->title,0,45,'utf-8')." .." : $blog->title}}</p>
                                        <span class="date">{{date('j M, Y', strtotime($blog->created_at))}}</span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                    <div class="tags">
                        <h6 class="text-capitalize mb-30 pb-10 mt-50">tags</h6>
                        @foreach($tags as $tag)
                            @if(!empty($tag))
                                <a href="{{ route('front.blogtags',$tag) }}">{{ $tag }}</a>
                            @endif
                        @endforeach                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="comment container">
        <div class="row">
            <div class="col-lg-9">
                <div class="comment-count mt-120">
                    <h3 class="mb-30">2 comments</h3>
                    <ul>
                        <li class="flex left-center mb-50">
                            <div class="comment-img">
                                <img src="assets/img/avater.png" alt="comment img">
                            </div>
                            <div class="comment-text flex left-center flex-wrap pl-30">
                                <h5 class="commenter mr-30 mb-0">John Doe</h5>
                                <span class="time">13 June, 2019 at 07:30</span>
                                <p class="comment w-100 mt-10">Ut enim ad minima veniam, quis nostrum exerci tationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea.</p>
                            </div>
                            <a class="reply-btn" href="#">Reply</a>
                        </li>
                        <li class="flex left-center mb-50 reply ml-160">
                            <div class="comment-img">
                                <img src="assets/img/avater.png" alt="comment img">
                            </div>
                            <div class="comment-text flex left-center flex-wrap pl-30">
                                <h5 class="commenter mr-30 mb-0">John Doe</h5>
                                <span class="time">13 June, 2019 at 07:30</span>
                                <p class="comment w-100 mt-10">Ut enim ad minima veniam, quis nostrum exerci tationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea.</p>
                            </div>
                            <a class="reply-btn" href="#">Reply</a>
                        </li>
                        <li class="flex left-center mb-50">
                            <div class="comment-img">
                                <img src="assets/img/avater.png" alt="comment img">
                            </div>
                            <div class="comment-text flex left-center flex-wrap pl-30">
                                <h5 class="commenter mr-30 mb-0">John Doe</h5>
                                <span class="time">13 June, 2019 at 07:30</span>
                                <p class="comment w-100 mt-10">Ut enim ad minima veniam, quis nostrum exerci tationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea.</p>
                            </div>
                            <a class="reply-btn" href="#">Reply</a>
                        </li>
                    </ul>
                </div>
                <div class="leave-comment basic-form">
                    <h3 class="mb-50">Leave a Comment</h3>
                    <form>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group ">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control shadow-black" id="name">
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group ">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control shadow-black" id="email">
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group ">
                                    <label for="website">website</label>
                                    <input type="text" class="form-control shadow-black" id="website">
                                    </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="comment-text">write comment</label>
                                    <textarea class="form-control shadow-black" id="comment-text" rows="3"></textarea>
                                    </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Single-blog end -->
@endsection