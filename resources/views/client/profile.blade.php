@extends( "layouts.client_master" )
@section( "title", "Trang cá nhân" )

@section( "content" )
<div class=" dark:bg-gray-900 flex flex-wrap items-center justify-center">
    <div class="w-full bg-white dark:bg-gray-800 shadow-lg transform duration-200 easy-in-out">

        <div class="h-2/4 sm:h-52 overflow-hidden">
            <img class="w-full" src="https://images.unsplash.com/photo-1638803040283-7a5ffd48dad5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80" alt="Photo by aldi sigun on Unsplash" />
        </div>
        <div class="flex justify-start px-5 -mt-12">
            <span clspanss="block relative h-32 w-32">
                <img alt="Photo by aldi sigun on Unsplash" src="{{ asset( 'images/avata/man.png' ) }}" class="mx-auto object-cover rounded-full h-24 w-24 bg-white p-1" />
            </span>
            <h2 class="text-2xl mt-5 mx-2 font-bold text-green-700 bg-white rounded px-2 dark:bg-white">
                {{ strtoupper( \Auth::user()->name ) }}
            </h2>
        </div>
        <div class="container m-auto max-w-3xl">
            {{-- <div class="hidden">
                <div class="flex p-4 w-5/6 m-auto mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800 " id="divError" role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <span class="font-medium">Vui lòng kiểm tra lại:</span>
                        <ul class="mt-1.5 ml-4  mx-2 text-red-700 list-disc list-inside" id="error">
                        </ul>
                    </div>
                </div>
            </div> --}}

            @if ( Session::has( "message" ) )
                <div id="toast-simple" class=" my-4 flex items-center p-4 space-x-4 w-full text-gray-500 bg-white rounded-lg divide-x divide-gray-200 shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
                    <svg aria-hidden="true" class="w-5 h-5 text-green-600 dark:text-blue-500" focusable="false" data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"></path></svg>
                    <div class="pl-4 text-sm font-normal">{{ Session::get( "message" )}}</div>
                </div>
            @endif
            <div class="px-7 mb-8">
                <div class="grid grid-cols-4 gap-4">
                    <span class="mt-2">Email: </span><input disabled id="email" type="text" class="col-span-3 text-black mt-2 px-2 border-2  dark:border-gray-500 dark:text-gray-400" value="{{ Auth::user()->email }}">
                    <span class="mt-2">Ngày sinh: </span><input disabled id="birthday" type="date" class="col-span-3 text-black mt-2 px-2 border-2  dark:border-gray-500 dark:text-gray-400" value="{{ Auth::user()->birthday }}">
                    <span class="mt-2">Phonenumber: </span><input disabled id="phoneNumber" type="text" class="col-span-3 text-black mt-2 px-2 border-2  dark:border-gray-500 dark:text-gray-400" value="{{ Auth::user()->phonenumber }}">
                    <span class="mt-2">Địa chỉ: </span><input disabled id="_name_address" type="text" class="col-span-3 text-black mt-2 px-2 border-2  dark:border-gray-500 dark:text-gray-400" value="{{ Auth::user()->address }}">
                </div>
                <div class="text-center py-3">
                    {{-- <a href="" class="text-blue-700  p-2 hover:bg-blue-500 hover:text-white rounded">Thay đổi địa chỉ</a>
                    <a href="" class="text-blue-700  p-2 hover:bg-blue-500 hover:text-white rounded">Thay đổi mật khẩu</a> --}}
                </div>
                {{-- <a href="{{ route( 'account.password' ) }}" class="text-center m-auto justify-center px-4 py-2 cursor-pointer bg-blue-600 max-w-fit mx-auto mt-8 rounded-lg text-white hover:bg-blue-700 hover:text-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-gray-200">
                    Thay đổi thông tin
                </a> --}}
            </div>
        </div>
    </div>
</div>
@endsection
