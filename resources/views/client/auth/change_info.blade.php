@extends( "layouts.client_master" )
@section( "title", "Thay đổi thông tin" )

@section('css')
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section( "content" )

<div class="bg-gray-100">
    <div class="container mx-auto my-5 p-5">
        <div class="md:flex no-wrap md:-mx-2 ">
            <div class="w-full md:w-3/12 md:mx-2">
                <div class="bg-white p-3 border-t-4 border-green-400">
                    <div class="image overflow-hidden">
                        <img class="h-auto w-full mx-auto" src="{{ url_image( auth()->user()->avata ) }}" alt="Avata">
                    </div>
                    <h1 class="text-gray-900 font-bold text-xl leading-8 my-1 text-center">{{ auth()->user()->name }}</h1>
                    <ul
                        class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                        <li class="flex items-center py-3">
                            <span>Status</span>
                            <span class="ml-auto"><span
                                    class="bg-green-500 py-1 px-2 rounded text-white text-sm">Active</span></span>
                        </li>
                        <li class="flex items-center py-3">
                            <span>Thành viên kể từ</span>
                            <span class="ml-auto">{{ auth()->user()->created_at->format('d-m-Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Right Side -->
            <div class="w-full md:w-9/12 mx-2 h-64">
                <!-- Profile tab -->
                <!-- About Section -->
                <div class="bg-white p-3 shadow-sm rounded-sm">
                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                        <span clas="text-green-500">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="tracking-wide">@yield('title')</span>
                    </div>
                    <div class="text-gray-700">
                        <div class="m-auto max-w-3xl">
                            <x-errors.any />
                            <form action="{{ route( 'account.changeinfo' ) }}" method="post" class="mt-5">
                                @csrf
                                <x-account.divInput type="text" name="name" label="Họ và tên" value="{{ \Auth::user()->name }}" />
                                <div class="relative z-0 mb-6 w-full group">
                                    <label for="" class="text-sm w-full @error("gender") text-red-400 @enderror">Giới tính @error("gender") {{ $message }}@enderror</label>
                                    <div class="mt-2">
                                        <input type="radio" name="gender" value="1" id="male"  @if ( old("gender", \Auth::user()->gender ) ) checked @endif>
                                        <label for="male" class="w-full">Nam</label>
                                        <input type="radio" name="gender" value="0" id="female"  @if ( old("gender", \Auth::user()->gender ) == 0 ) checked @endif>
                                        <label for="female" class="w-full">Nữ</label>
                                    </div>
                                </div>
                                <x-account.divInput type="email" name="email" label="Địa chỉ email" value="{{ \Auth::user()->email }}" />
                                <x-account.divInput type="date" name="birthday" label="Ngày sinh" value="{{ \Auth::user()->birthday }}" />
                                <x-account.divInput type="tel" name="phonenumber" label="Số điện thoại" value="{{ \Auth::user()->phonenumber }}" />
                                <button type="submit" class=" mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section( "script" )
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script>
        $( "#changeAvata" ).click( function () {
            $( "#inputAvate" ).click();
        });

        $( "#inputAvate" ).change( function () {
            $( "#formChangAvata").submit();
        });
    </script>
@endsection
