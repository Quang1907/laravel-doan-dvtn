@extends( "layouts.client_master" )
@section( "title", $post->title )

@section( "content" )
<div class=" mx-auto">
    <main class="mb-4">
        <div class="mb-4 md:mb-0 w-full max-w-screen-md mx-auto relative" style="height: 24em;">
            <div class="absolute left-0 bottom-0 w-full h-full z-10"
            style="background-image: linear-gradient(180deg,transparent,rgba(0,0,0,.7));"></div>
            <img src="{{ url_image( $post->image ) }}" class="absolute left-0 top-0 w-full h-full z-0 object-cover" />
            <div class="p-4 absolute bottom-0 left-0 z-20">
                <h2 class="text-4xl font-semibold text-gray-100 leading-tight">
                {{ $post->title }}
                </h2>
                <div class="flex mt-3">
                    <img src="{{ url_image( $post->user->avata ) }}"
                    class="h-10 w-10 rounded-full mr-2 object-cover" />
                    <div>
                    <p class="font-semibold text-gray-200 text-sm"> {{ $post->user->name }} </p>
                    <p class="font-semibold text-gray-400 text-xs"> {{ format_date( $post->created_at ) }} </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 lg:px-0 mt-4 text-gray-700 max-w-screen-md mx-auto text-lg leading-relaxed break-all">
            {!! $post->content !!}
        </div>
    </main>
  </div>
@endsection
