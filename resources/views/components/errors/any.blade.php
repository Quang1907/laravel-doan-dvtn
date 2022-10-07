@if ( $errors->any() )
<div class="bg-red-50 mt-3 border-l-8 border-red-900 mb-2">
    <div class="flex items-center">
        <div class="p-2">
            <div class="flex items-center">
                <div class="ml-2">
                    <svg class="h-8 w-8 text-red-900 mr-2 cursor-pointer"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="px-6 py-4 text-red-900 font-semibold text-lg">Vui lòng kiểm tra lại</p>
            </div>
            <div class="px-16 mb-4">
                @foreach ( $errors->all() as $error)
                    <li class="text-md font-bold text-red-500 text-sm">{{ $error }}</li>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
