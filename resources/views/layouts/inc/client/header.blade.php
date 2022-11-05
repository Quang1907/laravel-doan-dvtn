<nav class="bg-blue-600 border-gray-200 dark:border-gray-600 dark:bg-gray-900">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 md:px-6 py-2.5">
        <a href="{{ route( 'home' ) }}" class="flex items-center md:m-auto">
            <img src="{{ asset('images/logo/huyhieudoan.png') }}" class="mr-3 h-20 sm:h-25" alt="Flowbite Logo">
            <span class="self-center text-white text-xl font-semibold whitespace-nowrap dark:text-white">Đoàn Viên Thanh
                Niên</span>
        </a>

        <button data-collapse-toggle="mega-menu-full" id="button-nav" type="button"
            class="inline-flex text-white items-center p-2 ml-1 text-sm rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="mega-menu-full" aria-expanded="false">
            <svg class="w-6 h-6 text-black" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        <div id="mega-menu-full"
            class="hidden md:flex justify-between items-center w-full  md:w-auto md:order-1 md:m-auto">
            <ul
                class="flex flex-col pl-4 items-center  bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-2 sm:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ route( 'home' ) }}" class="block py-2 px-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Trang chủ</a>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="nav_div">Hoạt động
                        <svg class="ml-1 w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd">
                            </path>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar" class="hidden z-10 w-44 font-normal bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                            @foreach ( $showCategories as $category )
                                <li>
                                    <a href="{{ route( 'category.post.slug',  $category->slug ) }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="sipping-wheel" class="nav_div">Game
                        <svg class="ml-1 w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd">
                            </path>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="sipping-wheel" class="hidden z-10 w-44 font-normal bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="{{ url( 'sipping-wheel' ) }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Vòng quay may mắn</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- @php( $html = "" )
                {{ show_category_post( $categories, $html ) }}

                {{ dd( $html ) }} --}}
                {{-- @foreach ( $categories as $category )
                    <li>
                        <a href="{{ route( 'category.post.slug', $category->slug )}}"
                        class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700"
                        aria-current="page">{{ $category->name }}</a>
                    </li>
                @endforeach --}}
                {{-- @foreach ( config( "client.navbar" ) as $menu )
                    <li>
                        <a href="{{ route( $menu[ 'route' ] ) }}"
                        class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700"
                        aria-current="page">{{ $menu[ 'name' ] }}</a>
                    </li>
                @endforeach --}}
                <li class="flex">
                    @guest
                        @if (Route::has('dangnhap'))
                            <a class="nav-link hover:bg-blue-700 bg-blue-600 text-white py-2 px-3 rounded mr-4 my-2" href="{{ route( 'dangnhap' ) }}">{{ __('Đăng nhập') }}</a>
                        @endif
                    @else
                        <div class="flex items-center md:order-2">
                            <button type="button" id="profileUser"
                                class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                                <img id="avata" alt="Photo by aldi sigun on Unsplash" src="{{ url_image( Auth::user()->avata ) }}" class="mx-auto object-cover rounded-full h-[40px] bg-white w-[40px]" />
                            </button>
                            <div class="flex justify-start px-2">
                                <span clspanss="block relative">
                                </span>
                            </div>
                            <div class="z-50 absolute mt-[230px] right-0 mr-20 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                id="user-dropdown">
                                <div class="py-3 px-4">
                                    <span
                                        class="block text-sm text-gray-900 dark:text-white m-0"> {{ Auth::user()->name }}</span>
                                    <span
                                        class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400"> {{ Auth::user()->email }}</span>
                                </div>
                                <ul class="py-1" aria-labelledby="user-menu-button">
                                    @if ( Auth::user()->admin == true)
                                        <li>
                                            <a href="{{ url( 'admin' ) }}"
                                                class="block py-2 px-4 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Trang
                                                quản lý</a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="{{ route( 'profile' ) }}"
                                            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Trang
                                            cá nhân</a>
                                    </li>
                                    <li>
                                        <a href="{{ route( 'calendar' ) }}"
                                            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                            Lịch hoạt động
                                        </a>
                                    </li>
                                    <li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                            <button
                                            class="block py-2 px-4 w-full text-left text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                            Đăng xuất</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endguest
                </li>
            </ul>
        </div>
    </div>
</nav>
