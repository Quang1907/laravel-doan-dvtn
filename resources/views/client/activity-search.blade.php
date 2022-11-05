@extends('layouts.client_master')
@section('title', 'Hoạt động')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
        integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div id="carouselExampleCaptions" class="carousel slide relative" data-bs-ride="carousel">
        <div class="carousel-inner relative  w-full overflow-hidden">
            @php( $active = 'active' )
            @foreach ( $sliders as $slider)
                <div class="carousel-item h-96 relative float-left w-full {{ $active }}">
                    <img src="{{ asset($slider->image) }}" class="block w-full" alt="..." />
                    <div class="carousel-caption hidden md:block absolute text-center border border-blue-900 bg-blue-400 rounded-xl">
                        <h5 class="text-5xl text-white  font-bold uppercase">{{ $slider->title }}</h5>
                        <p class="text-3xl text-white">{{ $slider->description }}</p>
                    </div>
                </div>
                @php( $active = '' )
            @endforeach
        </div>
        <button
            class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
            type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button
            class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
            type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <section class="section">
        <div class="container">
            <div class="columns is-multiline is-desktop">
                @if ( !empty( $category ) )
                    <div class="column is-8-desktop">
                        <h1 class="h2 mb-5">Hiển thị các mục: <mark>{{ $category->name }}</mark></h1>
                        @foreach ( $category->posts as $post )
                            <article class="card mb-4">
                                <div class="post-slider">
                                    <img src="{{ url_image( $post->image ) }}" class="card-img-top" alt="post-thumb">
                                </div>
                                <div class="card-body">
                                    <h3 class="mb-3"><a class="post-title" href="#">{{ $post->title }}</a></h3>
                                    <ul class="card-meta list-inline">
                                        <li class="list-inline-item">
                                            <button href="#" class="card-meta-author">
                                                <img src="{{ url_image( $post->user->avata ) }}">
                                                <span>{{ $post->user->name }}</span>
                                            </button>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="ti-timer"></i>{{ format_date( $post->created_at ) }}
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="ti-calendar"></i>{{ $post->created_at->format( "d-m-Y" ) }}
                                        </li>
                                        <li class="list-inline-item">
                                            <ul class="card-meta-tag list-inline">
                                                @foreach ( $post->categories as $category )
                                                    <li class="list-inline-item"><a href="">{{ $category->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                    <div class="showContent">{!! $post->content !!}</div>
                                    <a href="{{ route( 'category.post.slug', [ $category->slug, $post->slug ]) }}" class="mt-3 btn bg-primary hover:text-blue-100 text-white">Xem thêm</a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @elseif( !empty( $allCategories ) && $allCategories->count() > 0 )
                    <div class="column is-8-desktop">
                        @if (request()->search )
                            <h1 class="h2 mb-5">Bạn đang tìm kiếm: <mark>{{ request()->search }}</mark></h1>
                        @else
                            <h1 class="h2 mb-5">Tất cả hoạt động<mark></mark></h1>
                        @endif
                        @foreach ( $allCategories as $allcategory )
                            @foreach ( $allcategory->posts as $post )
                                <article class="card mb-4">
                                    <div class="post-slider">
                                        <img src="{{ url_image( $post->image ) }}" class="card-img-top" alt="post-thumb">
                                    </div>
                                    <div class="card-body">
                                        <h3 class="mb-3"><a class="post-title" href="#">{{ $post->title }}</a></h3>
                                        <ul class="card-meta list-inline">
                                            <li class="list-inline-item">
                                                <button href="#" class="card-meta-author">
                                                    <img src="{{ url_image( $post->user->avata ) }}">
                                                    <span>{{ $post->user->name }}</span>
                                                </button>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="ti-timer"></i>{{ format_date( $post->created_at ) }}
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="ti-calendar"></i>{{ $post->created_at->format( "d-m-Y" ) }}
                                            </li>
                                            <li class="list-inline-item">
                                                <ul class="card-meta-tag list-inline">
                                                    @foreach ( $post->categories as $category )
                                                        <li class="list-inline-item"><a href="">{{ $category->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                        <div class="showContent">{!! $post->content !!}</div>
                                        <a href="{{ route( 'category.post.slug', [ $category->slug, $post->slug ]) }}" class="mt-3 btn bg-primary hover:text-blue-100 text-white">Xem thêm</a>
                                    </div>
                                </article>
                            @endforeach
                        @endforeach
                    </div>
                @elseif ( $posts->count() > 0 )
                    <div class="column is-8-desktop">
                        @if (request()->search )
                            <h1 class="h2 mb-5">Bạn đang tìm kiếm: <mark>{{ request()->search }}</mark></h1>
                        @else
                            <h1 class="h2 mb-5">Tất cả hoạt động<mark></mark></h1>
                        @endif
                        @foreach ( $posts as $post )
                            <article class="card mb-4">
                                <div class="post-slider">
                                    <img src="{{ url_image( $post->image ) }}" class="card-img-top" alt="post-thumb">
                                </div>
                                <div class="card-body">
                                    <h3 class="mb-3"><a class="post-title" href="#">{{ $post->title }}</a></h3>
                                    <ul class="card-meta list-inline">
                                        <li class="list-inline-item">
                                            <button href="#" class="card-meta-author">
                                                <img src="{{ url_image( $post->user->avata ) }}">
                                                <span>{{ $post->user->name }}</span>
                                            </button>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="ti-timer"></i>{{ format_date( $post->created_at ) }}
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="ti-calendar"></i>{{ $post->created_at->format( "d-m-Y" ) }}
                                        </li>
                                        <li class="list-inline-item">
                                            <ul class="card-meta-tag list-inline">
                                                @foreach ( $post->categories as $category )
                                                    <li class="list-inline-item"><a href="">{{ $category->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                    <div class="showContent">{!! $post->content !!}</div>
                                    <a href="{{ route( 'category.post.slug', [ $category->slug, $post->slug ]) }}" class="mt-3 btn bg-primary hover:text-blue-100 text-white">Xem thêm</a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="column is-8-desktop">
                        <h1 class="h2 mb-5">Hiển thị các mục: <mark>{{ request()->search }}</mark></h1>
                        <h4>Hiện tại chưa thông tin.</h4>
                    </div>
                @endif
                @include( "layouts.inc.client.right-sidebar" )
            </div>
        </div>
    </section>
@endsection

@section('script')

    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.owl-carousel').owlCarousel({
            items: 1,
            loop: true,
            nav: false,
            autoplay: true,
            autoplayTimeout: 3000,
            smartSpeed: 450
        })

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
            $('.showContent').limit(550);
        });
    </script>
@endsection
