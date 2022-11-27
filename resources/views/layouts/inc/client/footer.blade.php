<footer class="bg-white">
    {{-- <div class="bg-blue-600 py-6">
        <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center gap-2">
                <div class="text-center md:text-left mb-3 md:mb-0">
                    <span class="text-gray-100 font-bold uppercase tracking-widest">Newsletter</span>
                    <p class="text-indigo-200">Subscribe to our newsletter</p>
                </div>

                <form class="w-full md:max-w-md flex gap-2">
                    <input placeholder="Email"
                        class="w-full flex-1 bg-blue-600 text-white placeholder-indigo-100 border border-white focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2" />
                    <button
                        class="inline-block bg-white hover:bg-gray-100 focus-visible:ring ring-indigo-300 text-indigo-500 active:text-indigo-600 text-sm md:text-base font-semibold text-center rounded outline-none transition duration-100 px-8 py-2">Send</button>
                </form>
            </div>
        </div>
    </div> --}}

    <div class="pt-12 lg:pt-16 bg-blue-600 ">
        <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-12 lg:gap-8 mb-16">
                <div class="col-span-full lg:col-span-2">
                    <!-- logo - start -->
                    <div class="lg:-mt-2 mb-4">
                        <a href="/"
                            class="inline-flex items-center text-black-800 text-xl md:text-2xl font-bold gap-2"
                            aria-label="logo">
                            <img src="{{ asset('images/logo/huyhieudoan.png') }}" class="mr-3 h-20 sm:h-25" alt="Flowbite Logo">
                            <span class="self-center text-white">{{ $websiteSetting->website_name ?? "Đoàn viên thanh niên" }}</span>
                        </a>
                    </div>
                    <!-- logo - end -->

                    <p class="text-white sm:pr-8 mb-6">{{ $websiteSetting->address ?? "Thừa Thiên Huế" }}</p>

                    <!-- social - start -->
                    <div class="flex gap-4">
                        @if ( $websiteSetting->facebook )
                            <a href="{{ $websiteSetting->facebook }}" target="_blank"
                                class="text-white hover:text-gray-300 active:text-gray-600 transition duration-100">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        @endif

                        @if ( $websiteSetting->twitter )
                            <a href="{{ $websiteSetting->twitter }}" target="_blank"
                                class="text-white hover:text-gray-300 active:text-gray-600 transition duration-100">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        @endif

                        @if ( $websiteSetting->instagram )
                            <a href="{{ $websiteSetting->instagram }}" target="_blank"
                                class="text-white hover:text-gray-300 active:text-gray-600 transition duration-100">
                                <i class="fa-brands fa-square-instagram"></i>
                            </a>
                        @endif

                        @if ( $websiteSetting->youtube )
                            <a href="{{ $websiteSetting->youtube }}" target="_blank"
                                class="text-white hover:text-gray-300 active:text-gray-600 transition duration-100">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        @endif
                    </div>
                    <!-- social - end -->
                </div>

                <!-- nav - start -->
                <div>
                    <div class="text-white font-bold tracking-widest uppercase mb-4">Products</div>

                    <nav class="flex flex-col gap-4">
                        <div>
                            <a href="#"
                                class="text-white hover:text-indigo-500 active:text-indigo-600 transition duration-100">Overview</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-white hover:text-indigo-500 active:text-indigo-600 transition duration-100">Solutions</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-white hover:text-indigo-500 active:text-indigo-600 transition duration-100">Pricing</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-white hover:text-indigo-500 active:text-indigo-600 transition duration-100">Customers</a>
                        </div>
                    </nav>
                </div>
                <!-- nav - end -->

                <!-- nav - start -->
                <div>
                    <div class="text-white font-bold tracking-widest uppercase mb-4">Company</div>

                    <nav class="flex flex-col gap-4">
                        <div>
                            <a href="#"
                                class="text-white hover:text-indigo-500 active:text-indigo-600 transition duration-100">About</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-white hover:text-indigo-500 active:text-indigo-600 transition duration-100">Investor
                                Relations</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-white hover:text-indigo-500 active:text-indigo-600 transition duration-100">Jobs</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-white hover:text-indigo-500 active:text-indigo-600 transition duration-100">Press</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-white hover:text-indigo-500 active:text-indigo-600 transition duration-100">Blog</a>
                        </div>
                    </nav>
                </div>
                <!-- nav - end -->

                <!-- nav - start -->
                <div>
                    <div class="text-white font-bold tracking-widest uppercase mb-4">liên lạc với chúng tôi</div>

                    <nav class="flex flex-col gap-4">
                        <div>
                            <a href="#"
                                class="text-white hover:text-indigo-500 active:text-indigo-600 transition duration-100">
                                <i class="fa-solid fa-location-dot"></i> {{ $websiteSetting->address ?? "phone 1" }}
                            </a>
                        </div>
                        <div>
                            <a href="#"
                                class="text-white hover:text-indigo-500 active:text-indigo-600 transition duration-100">
                                <i class="fa-solid fa-phone"></i> {{ $websiteSetting->phone1 ?? "phone 1" }}
                            </a>
                        </div>
                        <div>
                            <a href="#"
                                class="text-white hover:text-indigo-500 active:text-indigo-600 transition duration-100">
                                <i class="fa-solid fa-envelope"></i> {{ $websiteSetting->email1 ?? "email 1" }}
                            </a>
                        </div>
                    </nav>
                </div>
                <!-- nav - end -->

                <!-- nav - start -->
                <div>
                    <div class="text-white font-bold tracking-widest uppercase mb-4">Legal</div>

                    <nav class="flex flex-col gap-4">
                        <div>
                            <a href="#"
                                class="text-white hover:text-indigo-500 active:text-indigo-600 transition duration-100">Terms
                                of Service</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-white hover:text-indigo-500 active:text-indigo-600 transition duration-100">Privacy
                                Policy</a>
                        </div>

                        <div>
                            <a href="#"
                                class="text-white hover:text-indigo-500 active:text-indigo-600 transition duration-100">Cookie
                                settings</a>
                        </div>
                    </nav>
                </div>
                <!-- nav - end -->
            </div>

            <div class="text-white text-sm text-center border-t py-8">© 2021 - Present Flowrift. All rights
                reserved.</div>
        </div>
    </div>
</footer>
