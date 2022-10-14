@extends('layouts.admin_master')
@section('title', 'Edit category')
@section('content')
    <div class="container mt-3">
        <div class="card border-primary">
            <div class="card-header">
                <h2 class="text-center">Edit Category</h2>
            </div>
            <div class="card-body">
                <div class="text-right my-3">
                    <a href="{{ route('category.index') }}" class="btn btn-success"><i class="fa-solid fa-backward"></i></a>
                </div>
                @if (\Session::has('message'))
                    <div class="alert alert-success text-center">
                        <ul class="m-0">
                            <li class="list-unstyled">{!! \Session::get('message') !!}</li>
                        </ul>
                    </div>
                @endif
                <div class="mt-5 col-sm-4 mx-auto">
                    <form action="{{ route('category.update', $category) }}" method="post">
                        @method("PUT")
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $category->name }}" placeholder="Tên danh mục">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Danh mục cha</label>
                            @php
                                $htmlOption = null;
                                categorySelect( $categories, $htmlOption, $category->parent_id );
                            @endphp
                            <select class="form-control form-select-lg" name="parent_id">
                                <option value="" selected>Choose an category</option>
                                {!! $htmlOption !!}
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success float-end">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
