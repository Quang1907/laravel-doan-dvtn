@extends('layouts.admin_master')
@section('title', 'Create Category')
@section('content')
    <div class="container mt-3">
        <div class="card border-primary">
            <div class="card-header">
                <h2 class="text-center">Create Caetgory</h2>
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
                    <form action="{{ route('category.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="" placeholder="Tên danh mục">
                            <span class="text-danger">{{ $errors->first('name') }}</span>
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
