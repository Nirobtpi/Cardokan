@extends('frontend.master')

@section('content')
<!-- rts breadcrumb area start -->
<x-breadcrumb name="Blog" />
<!-- rts breadcrumb area end -->
<div class="rts-blog-area inner rts-section-gapTop">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="left">
                    <div class="row g-5">
                        @foreach ($blogs as $blog)
                        <div class="col-lg-6">
                            <div class="blog-wrapper">
                                <div class="image-area">
                                    <a href="{{ route('blogs.view',$blog?->slug) }}"><img src="{{ asset($blog?->image) }}" alt=""></a>
                                </div>
                                <div class="content">

                                    <p class="blog-meta">{{ $blog?->category_name }}</p>
                                    <h6><a href="{{ route('blogs.view',$blog?->slug) }}">{{ $blog?->title }}</a></h6>
                                    <div class="author-date">
                                        <div class="person">
                                            <img src="{{ asset('frontend/assets/images/blog/author-01.svg') }}"  alt="">
                                            Jack Alexander
                                        </div>
                                        <div class="date">{{ $blog?->created_at->format('F d,Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if ($blogs->hasPages())
                            <ul class="pagination custom-pagination">
                                {{-- Previous Page Link --}}
                                @if ($blogs->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $blogs->previousPageUrl() }}" rel="prev">&laquo;</a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                                    @if ($page == $blogs->currentPage())
                                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                                {{-- Next Page Link --}}
                                @if ($blogs->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $blogs->nextPageUrl() }}" rel="next">&raquo;</a>
                                    </li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sticky-top">
                    <div class="right-side-bar">
                        <div class="search-area side-box">
                            <h2>Cars Search</h2>
                            <form action="{{ route('blogs') }}">
                                <div class="input-wrapper">
                                    <input type="text" value="{{ request('search') }}" name="search" placeholder="Search Vehicles">
                                    <button type="submit"><i class="fa-regular fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="car-make side-box">
                            <h2>Car Categories</h2>
                            <ul class="checkbox-list">
                                @foreach ($categories as $category)
                                <li class="checkbox-item">
                                        <a class="text-dark" href="{{ route('blogs',['category'=>$category->slug]) }}">{{ $category->name }}</a>
                                    </label>
                                    <span>({{ $category->post_count }})</span>
                                </li>
                                 @endforeach
                            </ul>
                        </div>
                        <div class="recent-post side-box">
                            <h2>Recent Post</h2>
                            <ul class="blog-list">
                                @foreach ($resentBlogs as $blog)
                                <li>
                                    <div class="image-area">
                                        <a href="{{ route('blogs.view',$blog?->slug) }}">
                                            <img src="{{ asset($blog?->image) }}" width="100" alt="">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h6><a href="{{ route('blogs.view',$blog?->slug) }}">{{ $blog?->title }}</a></h6>
                                        <p class="blog-meta">{{ $blog?->created_at->format('F d,Y') }}</p>
                                    </div>
                                </li>
                                 @endforeach
                            </ul>
                        </div>
                        <div class="tag-area side-box">
                            <h2>Fuel</h2>
                            <ul>
                                @foreach ($alltags as $tag )
                                <li><a href="{{ route('blogs',['tag'=>$tag]) }}" class="text-dark">{{ $tag }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="ad-area">
                            <img src="assets/images/blog/ad.webp" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="rts-cta-area area-2">
    <div class="container">
        <div class="cta-inner">
            <h2 class="title">If you have any questions Please Call.</h2>
            <div class="contact">
                <a href="call-to_%2b16544521505.html">
                    <img src="assets/images/cta/call.svg" alt="">
                    +1-654-452-1505</a>
            </div>
            <img class="shape one" src="assets/images/cta/round.svg" alt="">
            <img class="shape two" src="assets/images/cta/line.svg" alt="">
        </div>
    </div>
</div>
@endsection
