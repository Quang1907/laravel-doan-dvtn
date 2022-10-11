<div class="flex justify-start px-5 -mt-12">
    <span clspanss="block relative h-32 w-32">
        @if ( Auth::user()->avata  )
            <img id="avata" alt="Photo by aldi sigun on Unsplash" src="{{ asset( 'storage/' . Auth::user()->avata ) }}" class="mx-auto object-cover rounded-full h-24 w-24 bg-white p-1" />
        @else
            <img id="avata" alt="Photo by aldi sigun on Unsplash" src="{{ asset( "images/avata/man.png") }}" class="mx-auto object-cover rounded-full h-24 w-24 bg-white p-1" />
        @endif
        <form action="{{ route( 'changeAvata', Auth::user() ) }}" method="post" id="formChangAvata" enctype="multipart/form-data">
            @csrf
            <input type="file" name="avata" class="hidden" accept="image/*" id="inputAvate">
            <div class="text-center mt-[-30px] text-transparent hover:text-white">
                <button type="button" id="changeAvata"><i class="fa-regular fa-pen-to-square"></i></button>
            </div>
        </form>
    </span>
    <h2 class="text-3xl mt-3 mx-2 font-bold text-white px-2">
        {{ \Auth::user()->name }}
    </h2>
</div>
