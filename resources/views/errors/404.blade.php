@extends('errors::minimal')

@section('title', __('Không tìm thấy trang'))
@section('content')
    <main class="flex h-screen w-full flex-col items-center justify-center bg-blue-400">
        <h1 class="text-9xl font-extrabold tracking-widest text-white">404</h1>
        <div class="absolute rotate-12 rounded bg-red-500 text-white px-2 text-sm">Không tìm thấy trang</div>
        <button class="mt-5">
            <a href="{{ url( '/' ) }}"
                class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring active:text-orange-500">
                <span
                    class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-white transition-transform group-hover:translate-y-0 group-hover:translate-x-0"></span>

                <span class="relative block border border-current bg-blue-600 px-8 py-3">
                    <router-link to="/">Quay trở lại</router-link>
                </span>
            </a>
        </button>
    </main>
@endsection
