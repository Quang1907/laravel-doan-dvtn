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
                    <table
                        class="table table-striped
                    table-hover
                    table-borderless
                    table-primary
                    align-middle">
                        <thead class="table-light">
                            <tr class="bg-danger">
                                <th>ID</th>
                                <th>Post name</th>
                                <th>Content</th>
                                <th>List Caetgory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider ">
                            <tr class="table-primary">
                                <td scope="row">{{ $post->id }}</td>
                                <td scope="row" class="w-25">{{ $post->title }}</td>
                                <td scope="row">{{ $post->content }}</td>
                                <td>
                                    <ul>
                                        @foreach ( $post->categories as $category )
                                            <li>
                                                {{ $category->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="w-25">
                                    <form action="{{ route('post.destroy', $post->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        @can( "update", $post )
                                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                                        @endcan
                                        @can( "delete", $post )
                                        <button class="btn btn-danger">Delete</button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
