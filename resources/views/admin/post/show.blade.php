@extends('layouts.admin_master')
@section('title', 'Information post')
@section('content')
    <div class="container mt-3">
        <div class="card border-primary">
            <div class="card-header">
                <h2 class="text-center">List Posts</h2>
            </div>
            <div class="card-body">
                @if (\Session::has('message'))
                    <div class="alert alert-success text-center">
                        <ul class="m-0">
                            <li class="list-unstyled">{!! \Session::get('message') !!}</li>
                        </ul>
                    </div>
                @endif
                <div class="table-responsive">
                    @can( "create", App\Models\Post::class )
                        <div class="text-right my-3">
                            <a href="{{ route('post.index') }}" class="btn btn-success"><i class="fa-solid fa-backward"></i></a>
                        </div>
                    @endcan
                    <div class="bg-white pb-6 sm:pb-8 lg:pb-12">
                        <div class="max-w-screen-md px-4 md:px-8 mx-auto">
                        <h1 class="text-gray-800 text-2xl sm:text-3xl font-bold text-center mb-4 md:mb-6">{{ $post->title }}</h1>
                            {!! $post->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
