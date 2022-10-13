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
                <!-- article - start -->
                <div class="flex flex-col bg-white border rounded-lg overflow-hidden">
                    <a href="#" class="group h-48 md:h-64 block bg-gray-100 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1593508512255-86ab42a8e620?auto=format&q=75&fit=crop&w=600" loading="lazy" alt="Photo by Minh Pham" class="w-full h-full object-cover object-center absolute inset-0 group-hover:scale-110 transition duration-200" />
                    </a>

                    <div class="flex flex-col flex-1 p-4 sm:p-6">
                        <h2 class="text-gray-800 text-lg font-semibold mb-2">
                        <a href="#" class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">{{ $post->title }}</a>
                        </h2>

                        <p class="text-gray-500 mb-8">{{ $post->content }}</p>

                        <div class="flex justify-between items-end mt-auto">
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 shrink-0 bg-gray-100 rounded-full overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1611898872015-0571a9e38375?auto=format&q=75&fit=crop&w=64" loading="lazy" alt="Photo by Brock Wegner" class="w-full h-full object-cover object-center" />
                            </div>

                            <div>
                            <span class="block text-indigo-500">Mike Lane</span>
                            <span class="block text-gray-400 text-sm">July 19, 2021</span>
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
