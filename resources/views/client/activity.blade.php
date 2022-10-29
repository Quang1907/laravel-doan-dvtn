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
            @php($active = 'active')
            @foreach ($sliders as $slider)
                <div class="carousel-item h-96 relative float-left w-full {{ $active }}">
                    <img src="{{ asset($slider->image) }}" class="block w-full" alt="..." />
                    <div class="carousel-caption hidden md:block absolute text-center border border-blue-900 bg-blue-400 rounded-xl">
                        <h5 class="text-5xl text-white  font-bold uppercase">{{ $slider->title }}</h5>
                        <p class="text-3xl text-white">{{ $slider->description }}</p>
                    </div>
                </div>
                @php($active = '')
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
                <div class="column is-8-desktop">
                    <h1 class="h2 mb-5">Hiển thị các mục: <mark>Hoạt động</mark></h1>
                    @foreach ( $category->posts as $post )
                        <article class="card mb-4">
                            <div class="post-slider">
                                <img src="{{ url_image( $post->image ) }}" class="card-img-top" alt="post-thumb">
                            </div>
                            <div class="card-body">
                                <h3 class="mb-3"><a class="post-title" href="{{ route('activity.post', $post->slug) }}">{{ $post->title }}</a></h3>
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
                                <a href="{{ route('activity.post', $post->slug) }}" class="mt-3 btn bg-primary hover:text-blue-100 text-white">Xem thêm</a>
                            </div>
                        </article>
                    @endforeach
                </div>
                @include( "layouts.inc.client.right-sidebar" )
            </div>
        </div>
    </section>
    {{-- <div class="bg-white">
            <!-- text - start -->
            <div class="mb-10 md:mb-16">
                <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-6">Các hoạt động trong thời
                    gian qua</h2>
                <p class="max-w-screen-md text-gray-500 md:text-lg text-center mx-auto">Cố gắng vì một tương lai tươi sáng
                </p>
            </div>
            <!-- text - end -->
            <section class="text-gray-600 body-font overflow-hidden">
                <div class="container px-5 mx-auto">
                    <div class="-my-8 divide-y-2 divide-gray-100">
                        @forelse ($category->posts as $post)
                            <div class="py-8 flex flex-wrap md:flex-nowrap">
                                <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                                    <a href="{{ route('activity', $post->slug) }}"
                                        class="group h-48 md:h-64 block bg-gray-100 overflow-hidden relative">
                                        <img src="{{ url_image($post->image) }}" loading="lazy" alt="Photo by Minh Pham"
                                            class="w-full h-full object-cover object-center absolute inset-0 group-hover:scale-110 transition duration-200" />
                                    </a>
                                </div>
                                <div class="md:flex-grow pl-3 mb-0">
                                    <a href="{{ route('activity', $post->slug) }}"
                                        class="hover:text-blue-500 text-2xl font-medium text-gray-900 title-font mb-2">{{ $post->title }}</a>
                                    <div class="showContent">{!! $post->content !!}</div>
                                    <div class="flex items-center gap-2 mt-5">
                                        <div class="w-10 h-10 shrink-0 bg-gray-100 rounded-full overflow-hidden">
                                            <img src="{{ url_image($post->user->avata) }}" loading="lazy"
                                                alt="Photo by Brock Wegner"
                                                class="w-full h-full object-cover object-center" />
                                        </div>
                                        <div>
                                            <span class="block text-indigo-500">{{ $post->user->name }}</span>
                                            <span
                                                class="block text-gray-400 text-sm">{{ format_date($post->created_at) }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('activity', $post->slug) }}"
                                        class="text-indigo-500 inline-flex items-center mt-4">Xem thêm
                                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                            <path d="M12 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    </div> --}}
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
