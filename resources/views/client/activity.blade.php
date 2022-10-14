@extends( "layouts.client_master" )
@section( "title", "Hoạt động" )

@section( "content" )
<div class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
        <!-- text - start -->
        <div class="mb-10 md:mb-16">
            <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-6">Các hoạt động trong thời gian qua</h2>

            <p class="max-w-screen-md text-gray-500 md:text-lg text-center mx-auto">Cố gắng vì một tương lai tươi sáng</p>
        </div>
        <!-- text - end -->

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6 xl:gap-8">
            @forelse ( $category->posts as $post )
                <div class="flex flex-col bg-white border rounded-lg overflow-hidden">
                    <a href="#" class="group h-48 md:h-64 block bg-gray-100 overflow-hidden relative">
                        @if ( stripos( $post->image,  "drive.google.com" ) )
                            <img src="{{ $post->image }}" loading="lazy" alt="Photo by Minh Pham" class="w-full h-full object-cover object-center absolute inset-0 group-hover:scale-110 transition duration-200" />
                        @else
                            <img src="{{ asset( "storage/" . $post->image ) }}" loading="lazy" alt="Photo by Minh Pham" class="w-full h-full object-cover object-center absolute inset-0 group-hover:scale-110 transition duration-200" />
                        @endif
                    </a>

                    <div class="flex flex-col flex-1 p-4 sm:p-6">
                        <h2 class="text-gray-800 text-lg font-semibold mb-2">
                        <a href="{{  url( "activity/" . $post->slug ) }}" class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">{{ $post->title }}</a>
                        </h2>
                        {!!  $post->content  !!}
                        <div class="flex justify-between items-end mt-auto">
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 shrink-0 bg-gray-100 rounded-full overflow-hidden">
                                @if ( stripos( $post->image,  "drive.google.com" ) )
                                    <img src="{{ $post->user->avata }}" loading="lazy" alt="Photo by Brock Wegner" class="w-full h-full object-cover object-center" />
                                @else
                                    <img src="{{ asset( "storage/" . $post->user->avata ) }}" loading="lazy" alt="Photo by Brock Wegner" class="w-full h-full object-cover object-center" />
                                @endif
                            </div>
                            <div>
                            <span class="block text-indigo-500">{{ $post->user->name }}</span>
                            <span class="block text-gray-400 text-sm">{{ format_date( $post->created_at ) }}</span>
                            </div>
                        </div>
                        <span class="text-gray-500 text-sm border rounded px-2 py-1">Article</span>
                        </div>
                    </div>
                </div>
                <!-- article - end -->
            @empty
            @endforelse
        </div>
    </div>
</div>
@endsection
