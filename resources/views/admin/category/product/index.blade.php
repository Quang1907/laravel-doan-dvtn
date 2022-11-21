@extends('layouts.admin_master')
@section('title', 'List of Products Categories')
@section('content')
    <div class="container mt-3">
        <div class="card border-primary">
            <div class="card-header">
                <h2 class="text-center h2">List of Products Categories</h2>
            </div>
            <div class="card-body">
                <div class="table">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <form action="" method="get" class="form-group flex-wrap">
                                <div class="dt-buttons btn-group flex-wrap">
                                    <div class="mt-3 px-1">
                                        <input type="search" name="search" class="form-control rounded-0 px-2" value="{{ request( 'search' ) }}" placeholder="Search category name" aria-controls="example1">
                                    </div>
                                    <div class="mt-3 px-1">
                                        <input type="date" name="date" class="form-control rounded-0 px-2" value="{{ request( 'date' ) }}" aria-controls="example1">
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-sm btn-primary  bg-primary mt-0">Search</button>
                                        <a href="{{ route( 'category-products.index' ) }}" type="submit" class="btn btn-sm btn-success bg-green-500 mt-0">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3 text-right">
                            <a href="{{ route('category-products.create') }}" class="btn btn-sm btn-success"><i class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                    @if (\Session::has('message'))
                        <div class="alert alert-success text-center">
                            <ul class="m-0">
                                <li class="list-unstyled">{!! \Session::get('message') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <table
                        class="table table-striped table-borderless table-primary align-middle">
                        <thead class="table-light">
                            <tr class="bg-danger">
                                <th>ID</th>
                                <th>Category name</th>
                                <th class="text-center my-auto">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @forelse ( $category_products as $category )
                                <tr class="table-primary">
                                    <td scope="row">{{ $category->id }}</td>
                                    <td scope="row" >{{ $category->name }}</td>
                                    <td class="text-center my-auto">
                                        <i class="@if ( $category->status ) text-success @else text-danger @endif fa-regular fa-circle-dot"></i>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route( "category-products.destroy" , $category->id ) }}" method="post">
                                            @csrf
                                            @method("DELETE")
                                                <div>
                                                    <a href="{{ route( "category-products.show" , $category->id ) }}" class="btn btn-sm btn-primary">List Products</a>
                                                    <a href="{{ route( "category-products.edit" , $category->id ) }}" class="btn btn-sm btn-warning text-white mx-1">Edit</a>
                                                    <button class="btn btn-sm btn-danger">Delete</button>
                                                </div>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Hiện tại không có danh mục</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $category_products->links('vendor.pagination.bootstrap') }}
                </div>
            </div>
        </div>
    </div>
@endsection
