@extends('layouts.client_master')
@section('title', 'Trang chu')

@section('content')
    <!-- start of banner -->
    <div class="banner has-text-centered">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-9-widescreen">
                    <h1 class="mb-6 h1 text-black">What Would You <br> Like To Read Today?</h1>
                    <ul class="widget-list-inline mb-4">
                        @foreach ( $categoryPosts as $tagPost )
                            <li class="list-inline-item"><a href="{{ route( 'category.post.slug', $tagPost->slug ) }}">{{ $tagPost->name }}</a></li>
                        @endforeach
                        @foreach ( $categoryProducts as $tagProduct )
                            <li class="list-inline-item"><a href="{{ route( 'category.product.slug', $tagProduct->slug ) }}">{{ $tagProduct->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>


        <svg class="banner-shape-1" width="39" height="40" viewBox="0 0 39 40" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z" stroke="#040306"
                stroke-miterlimit="10" />
            <path class="path" d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
                stroke-miterlimit="10" />
        </svg>

        <svg class="banner-shape-2" width="39" height="39" viewBox="0 0 39 39" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_d)">
                <path class="path"
                    d="M24.1587 21.5623C30.02 21.3764 34.6209 16.4742 34.435 10.6128C34.2491 4.75147 29.3468 0.1506 23.4855 0.336498C17.6241 0.522396 13.0233 5.42466 13.2092 11.286C13.3951 17.1474 18.2973 21.7482 24.1587 21.5623Z" />
                <path
                    d="M5.64626 20.0297C11.1568 19.9267 15.7407 24.2062 16.0362 29.6855L24.631 29.4616L24.1476 10.8081L5.41797 11.296L5.64626 20.0297Z"
                    stroke="#040306" stroke-miterlimit="10" />
            </g>
            <defs>
                <filter id="filter0_d" x="0.905273" y="0" width="37.8663" height="38.1979"
                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                    <feOffset dy="4" />
                    <feGaussianBlur stdDeviation="2" />
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape" />
                </filter>
            </defs>
        </svg>


        <svg class="banner-shape-3" width="39" height="40" viewBox="0 0 39 40" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z" stroke="#040306"
                stroke-miterlimit="10" />
            <path class="path" d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
                stroke-miterlimit="10" />
        </svg>


        <svg class="banner-border" height="240" viewBox="0 0 2202 240" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M1 123.043C67.2858 167.865 259.022 257.325 549.762 188.784C764.181 125.427 967.75 112.601 1200.42 169.707C1347.76 205.869 1901.91 374.562 2201 1"
                stroke-width="2" />
        </svg>
    </div>
    <!-- end of banner -->
    <section class="section pb-0">
        <div class="container">
            <div class="columns is-desktop is-multiline">
                {{-- host new  --}}
                <div class="column is-4-widescreen is-6-desktop mb-5">
                    <h2 class="h5 section-title">host news</h2>
                    @forelse ( $hot_news as $hot_new )
                        <article class="card mb-4">
                            <div class="post-slider">
                                <img src="{{ url_image( $hot_new->image ) }}" class="card-img-top" alt="post-thumb">
                            </div>
                            <div class="card-body">
                                <h3 class="mb-3"><a class="post-title" href="{{ route( 'viewPost', $hot_new->slug ) }}">{{ $hot_new->title }}</a></h3>
                                <ul class="card-meta list-inline">
                                    <li class="list-inline-item">
                                        <button href="#" class="card-meta-author">
                                            <img src="{{ url_image( $hot_new->user->avata ) }}">
                                            <span>{{ $hot_new->user->name }}</span>
                                        </button>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-timer"></i>{{ format_date( $hot_new->created_at ) }}
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-calendar"></i>{{ $hot_new->created_at->format( "d-m-Y" ) }}
                                    </li>
                                    <li class="list-inline-item">
                                        <ul class="card-meta-tag list-inline">
                                            @foreach ( $hot_new->categories as $category )
                                                <li class="list-inline-item"><a href="{{ route( 'category.post.slug', $category->slug ) }}">{{ $category->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                                <div class="showContent">{!! $hot_new->content !!}</div>
                                <a href="{{ route( 'viewPost', $hot_new->slug ) }}" class="mt-3 btn bg-primary hover:text-blue-100 text-white">Xem thêm</a>
                            </div>
                        </article>
                    @empty
                    <span> Hiện tại chưa có bài viết</span>
                    @endforelse
                </div>
                {{-- trending post --}}
                <div class="column is-4-widescreen is-6-desktop mb-5">
                    <h2 class="h5 section-title">Trending Post</h2>
                    @forelse ( $trending_post as $trending_post_item )
                        <article class="card mb-5">
                            <div class="card-body is-flex">
                                <img class="card-img-sm" src="{{ url_image( $trending_post_item->image ) }}">
                                <div class="ml-3">
                                    <h4><a href="{{ route( 'viewPost', $trending_post_item->slug ) }}" class="post-title">{{ $trending_post_item->title }}</a></h4>
                                    <ul class="card-meta mt-2">
                                        <li class="list-inline-item mb-0">
                                            <i class="ti-calendar"></i>{{ $trending_post_item->created_at->format( "d-m-Y h:i A" ) }}
                                        </li>
                                        <li class="list-inline-item mb-0">
                                            <i class="ti-timer"></i>{{ format_date( $trending_post_item->created_at ) }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    @empty
                        Hiện chưa có bài viết nổi bật
                    @endforelse
                </div>
                {{-- populer post  --}}
                <div class="column is-4-widescreen mb-5">
                    <h2 class="h5 section-title">Popular Post</h2>
                    @forelse ( $popular_posts as $popular_post )
                        <article class="card mb-4">
                            <div class="post-slider">
                                <img src="{{ url_image( $popular_post->image ) }}" class="card-img-top" alt="post-thumb">
                            </div>
                            <div class="card-body">
                                <h3 class="mb-3"><a class="post-title" href="{{ route( 'viewPost', $popular_post->slug ) }}">{{ $popular_post->title }}</a></h3>
                                <ul class="card-meta list-inline">
                                    <li class="list-inline-item">
                                        <button href="#" class="card-meta-author">
                                            <img src="{{ url_image( $popular_post->user->avata ) }}">
                                            <span>{{ $popular_post->user->name }}</span>
                                        </button>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-timer"></i>{{ format_date( $popular_post->created_at ) }}
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-calendar"></i>{{ $popular_post->created_at->format( "d-m-Y" ) }}
                                    </li>
                                    <li class="list-inline-item">
                                        <ul class="card-meta-tag list-inline">
                                            @foreach ( $popular_post->categories as $category )
                                                <li class="list-inline-item"><a href="{{ route( 'category.post.slug', $category->slug ) }}">{{ $category->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                                <div class="showContent">{!! $popular_post->content !!}</div>
                                <a href="{{ route( 'viewPost', $popular_post->slug ) }}" class="mt-3 btn bg-primary hover:text-blue-100 text-white">Xem thêm</a>
                            </div>
                        </article>
                    @empty
                        <span> Hiện tại chưa có bài viết</span>
                    @endforelse
                </div>
                <div class="column is-12">
                    <div class="border-bottom border-default"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns is-multiline is-desktop is-justify-content-center">
                <div class="column is-8-desktop mb-5">
                    <h2 class="h5 section-title">BÀI ĐĂNG GẦN ĐÂY</h2>
                    @forelse ( $allPosts as $postItem )
                        <article class="card mb-4">
                            <div class="post-slider">
                                <img src="{{ url_image( $postItem->image ) }}" class="card-img-top" alt="post-thumb">
                            </div>
                            <div class="card-body">
                                <h3 class="mb-3"><a class="post-title" href="{{ route( 'viewPost', $postItem->slug ) }}">{{ $postItem->title }}</a></h3>
                                <ul class="card-meta list-inline">
                                    <li class="list-inline-item">
                                        <button type="button" class="card-meta-author">
                                            <img src="{{ url_image( $postItem->user->avata ) }}">
                                            <span>{{ $postItem->user->name }}</span>
                                        </button>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-timer"></i>{{ format_date( $postItem->created_at ) }}
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-calendar"></i>{{ $postItem->created_at->format( "d-m-Y" ) }}
                                    </li>
                                    <li class="list-inline-item">
                                        <ul class="card-meta-tag list-inline">
                                            @foreach ( $postItem->categories as $category )
                                                <li class="list-inline-item"><a href="">{{ $category->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                                <div class="showContent">{!! $postItem->content !!}</div>
                                <a href="{{ route( 'viewPost', $postItem->slug ) }}" class="mt-3 btn bg-primary hover:text-blue-100 text-white">Xem thêm</a>
                            </div>
                        </article>
                    @empty
                        Hiện tại chưa có bài viết
                    @endforelse
                    {{ $allPosts->appends( request()->all() )->links( "vendor.pagination.client" ) }}
                </div>
                @include( "layouts.inc.client.right-sidebar")
            </div>
        </div>
    </section>
@endsection

@section( 'script' )
<script>
    $(function() {
        $.fn.limit = function($n) {
            this.each(function() {
                var allText = $(this).html();
                var tLength = $(this).html().length;
                var startText = allText.slice(0, $n);
                if (tLength >= $n) {
                    $(this).html(startText + '...');
                } else {
                    $(this).html(startText);
                };
            });

            return this;
        }
        $('.showContent').limit(100);
    });
</script>
@endsection

