@extends( "layouts.client_master" )
@section( "title", "Hoạt động" )

@section( "content" )

    <div id="default-carousel" class="relative" data-carousel="static">
        <div class="owl-carousel owl-theme">
            @foreach ( config( "carousel.image" ) as $image )
                <div class="mt-72">
                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-0 z-20" data-carousel-item="">
                        <img src="{{ $image }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white">
        <div class="max-w-screen-2xl px-4 md:px-8 mx-auto mb-5">
            <!-- text - start -->
            <div class="mb-10 md:mb-16">
                <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-6">Các hoạt động trong thời gian qua</h2>
                <p class="max-w-screen-md text-gray-500 md:text-lg text-center mx-auto">Cố gắng vì một tương lai tươi sáng</p>
            </div>
            <!-- text - end -->
            <section class="text-gray-600 body-font overflow-hidden">
                <div class="container px-5 mx-auto">
                    <div class="-my-8 divide-y-2 divide-gray-100">
                        @forelse (  $category->posts as $post )
                            <div class="py-8 flex flex-wrap md:flex-nowrap">
                                <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                                    <a href="{{  route( "activity" , $post->slug ) }}" class="group h-48 md:h-64 block bg-gray-100 overflow-hidden relative">
                                        <img src="{{ url_image( $post->image ) }}" loading="lazy" alt="Photo by Minh Pham" class="w-full h-full object-cover object-center absolute inset-0 group-hover:scale-110 transition duration-200" />
                                    </a>
                                </div>
                                <div class="md:flex-grow pl-3 mb-0">
                                    <a href="{{  route( "activity" , $post->slug ) }}" class="hover:text-blue-500 text-2xl font-medium text-gray-900 title-font mb-2" >{{ $post->title }}</a>
                                    <div class="showContent">{!! $post->content !!}</div>
                                    <div class="flex items-center gap-2 mt-5">
                                        <div class="w-10 h-10 shrink-0 bg-gray-100 rounded-full overflow-hidden">
                                                <img src="{{ url_image(  $post->user->avata ) }}" loading="lazy" alt="Photo by Brock Wegner" class="w-full h-full object-cover object-center" />
                                        </div>
                                        <div>
                                            <span class="block text-indigo-500">{{ $post->user->name }}</span>
                                            <span class="block text-gray-400 text-sm">{{ format_date( $post->created_at ) }}</span>
                                        </div>
                                    </div>
                                    <a href="{{  route( "activity" , $post->slug ) }}" class="text-indigo-500 inline-flex items-center mt-4">Xem thêm
                                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
    </div>
@endsection

@section('script')

    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.owl-carousel').owlCarousel({
            items   : 1,
            loop    : true,
            nav     : false,
            autoplay: true,
            autoplayTimeout : 3000,
            smartSpeed:450
        })

        $(function(){
            $.fn.limit = function( $n ){
                this.each(function(){
                    var allText   = $(this).html();
                    var tLength   = $(this).html().length;
                    var startText = allText.slice(0,$n);
                    if( tLength >= $n ){
                        $(this).html(startText+'...');
                    }else {
                        $(this).html(startText);
                    };
                });

                return this;
            }
            $('.showContent').limit(550);
        });
    </script>
@endsection
